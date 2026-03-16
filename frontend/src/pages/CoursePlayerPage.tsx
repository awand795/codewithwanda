import { useState, useEffect } from 'react'
import { useParams, useNavigate } from 'react-router-dom'
import { 
  ChevronLeft, ChevronRight, Play, CheckCircle, Code, BookOpen, 
  Lightbulb, Trophy, Lock, ShoppingCart, Sparkles 
} from 'lucide-react'
import { useCourse } from '@/hooks/useCourses'
import { useLesson } from '@/hooks/useLessons'
import { useExecuteCode, useRunTests } from '@/hooks/useCompiler'
import { useAuthStore } from '@/stores/authStore'
import { Button } from '@/components/ui/button'
import { Card, CardContent, CardDescription, CardHeader, CardTitle } from '@/components/ui/card'
import { Badge } from '@/components/ui/badge'
import { Separator } from '@/components/ui/separator'
import { useToast } from '@/hooks/use-toast'
import { Quiz } from '@/components/lessons/Quiz'
import ReactMarkdown from 'react-markdown'
import { Prism as SyntaxHighlighter } from 'react-syntax-highlighter'
import { vscDarkPlus } from 'react-syntax-highlighter/dist/esm/styles/prism'
import remarkGfm from 'remark-gfm'
import rehypeRaw from 'rehype-raw'
import type { AxiosError } from 'axios'

interface ErrorResponseData {
  message?: string
  type?: 'prerequisite' | 'purchase_required'
  course?: {
    id: number
    title: string
    slug: string
    price: number
    is_premium: boolean
  }
}

export default function CoursePlayerPage() {
  const { slug, lessonSlug } = useParams<{ slug: string; lessonSlug: string }>()
  const navigate = useNavigate()
  const { toast } = useToast()
  const { isAuthenticated } = useAuthStore()
  const { data: course, isLoading: courseLoading } = useCourse(slug || '')

  const [currentLessonIndex, setCurrentLessonIndex] = useState(0)
  const [code, setCode] = useState('')
  const [output, setOutput] = useState('')
  const [isRunning, setIsRunning] = useState(false)
  const [quizCompleted, setQuizCompleted] = useState(false)
  const [quizScore, setQuizScore] = useState(0)
  const [activeTab, setActiveTab] = useState<'content' | 'exercise'>('content')
  const [accessError, setAccessError] = useState<ErrorResponseData | null>(null)

  const { data: lesson, isLoading: lessonLoading, error } = useLesson(lessonSlug || '')
  
  const executeCode = useExecuteCode()
  const runTests = useRunTests()

  // Handle access errors
  useEffect(() => {
    if (error) {
      const axiosError = error as AxiosError<ErrorResponseData>
      // Only set access error for 403 (forbidden) errors
      // For 404 or other errors, let them be handled elsewhere
      if (axiosError.response?.status === 403) {
        const errorData = axiosError.response.data
        setAccessError(errorData)
      } else if (axiosError.response?.status === 404) {
        // Lesson not found - navigate back
        toast({
          title: 'Lesson tidak ditemukan',
          description: 'Lesson yang Anda cari tidak ada.',
          variant: 'destructive',
        })
      }
    } else {
      setAccessError(null)
    }
  }, [error, toast])

  useEffect(() => {
    if (lesson) {
      const lessonData = lesson as any
      if (lessonData?.starter_code) {
        setCode(lessonData.starter_code.replace(/\\n/g, '\n'))
      }
    }
  }, [lesson])

  const handleRunCode = async () => {
    const lessonData = lesson as any
    if (!lessonData?.programming_language) return

    setIsRunning(true)
    try {
      const result = await executeCode.mutateAsync({
        language: lessonData.programming_language,
        code,
      })

      const data = result.data as any
      if (data.success) {
        setOutput(data.output || 'Code executed successfully (no output)')
        toast({
          title: 'Code executed',
          description: 'Your code ran successfully!',
        })
      } else {
        setOutput(`Error: ${data.error || 'Unknown error'}`)
        toast({
          title: 'Execution failed',
          description: data.error,
          variant: 'destructive',
        })
      }
    } catch (error) {
      setOutput('Failed to execute code. Please try again.')
      toast({
        title: 'Error',
        description: 'Failed to execute code',
        variant: 'destructive',
      })
    } finally {
      setIsRunning(false)
    }
  }

  const handleRunTests = async () => {
    const lessonData = lesson as any
    if (!lessonData?.programming_language || !lessonData?.test_cases) return

    setIsRunning(true)
    try {
      const result = await runTests.mutateAsync({
        language: lessonData.programming_language,
        code,
        testCases: lessonData.test_cases,
      })

      const data = result.data as any
      if (data.success) {
        const passed = data.passed || 0
        const total = data.total_tests || 0
        setOutput(`Tests: ${passed}/${total} passed\n\n${JSON.stringify(data.results, null, 2)}`)
        toast({
          title: passed === total ? 'All tests passed!' : `${passed}/${total} tests passed`,
          variant: passed === total ? 'default' : 'destructive',
        })
      }
    } catch (error) {
      setOutput('Failed to run tests.')
      toast({
        title: 'Error',
        description: 'Failed to run tests',
        variant: 'destructive',
      })
    } finally {
      setIsRunning(false)
    }
  }

  const handleQuizComplete = (score: number) => {
    const lessonData = lesson as any
    const totalQuestions = lessonData.quiz?.length || 0
    setQuizScore(score)
    setQuizCompleted(true)
    toast({
      title: 'Quiz Completed!',
      description: `You scored ${score}/${totalQuestions}`,
    })
  }

  const handlePurchase = () => {
    if (isAuthenticated) {
      navigate(`/courses/${slug}`)
    } else {
      navigate('/login')
    }
  }

  // Loading state
  if (courseLoading || lessonLoading || (!lesson && !accessError)) {
    return (
      <div className="min-h-screen flex items-center justify-center">
        <div className="text-center">
          <div className="animate-spin rounded-full h-12 w-12 border-b-2 border-primary mx-auto"></div>
          <p className="mt-4 text-muted-foreground">Loading lesson...</p>
        </div>
      </div>
    )
  }

  // Access denied - Purchase required
  if (accessError?.type === 'purchase_required') {
    return (
      <div className="min-h-screen bg-gradient-to-br from-purple-50 to-pink-50 flex items-center justify-center p-4">
        <Card className="max-w-md w-full border-0 shadow-2xl">
          <CardHeader className="text-center pb-6">
            <div className="mx-auto mb-6 flex h-20 w-20 items-center justify-center rounded-full bg-gradient-to-br from-purple-100 to-pink-100">
              <Lock className="h-10 w-10 text-purple-600" />
            </div>
            <CardTitle className="text-3xl">Konten Premium</CardTitle>
            <CardDescription className="text-base mt-2">
              {accessError.message}
            </CardDescription>
          </CardHeader>
          <CardContent className="space-y-6">
            <div className="text-center">
              <p className="text-2xl font-bold text-gray-900">
                {accessError.course?.title}
              </p>
              <div className="mt-4 flex items-center justify-center gap-2">
                <span className="text-3xl font-bold text-primary">
                  Rp {accessError.course?.price?.toLocaleString('id-ID')}
                </span>
              </div>
            </div>

            <div className="space-y-3">
              <div className="flex items-center gap-3 text-sm text-gray-600">
                <CheckCircle className="h-5 w-5 text-green-500" />
                <span>Akses selamanya ke semua materi</span>
              </div>
              <div className="flex items-center gap-3 text-sm text-gray-600">
                <CheckCircle className="h-5 w-5 text-green-500" />
                <span>Latihan coding interaktif</span>
              </div>
              <div className="flex items-center gap-3 text-sm text-gray-600">
                <CheckCircle className="h-5 w-5 text-green-500" />
                <span>Kuis untuk menguji pemahaman</span>
              </div>
              <div className="flex items-center gap-3 text-sm text-gray-600">
                <CheckCircle className="h-5 w-5 text-green-500" />
                <span>Sertifikat setelah menyelesaikan</span>
              </div>
            </div>

            <Button 
              onClick={handlePurchase} 
              size="lg" 
              className="w-full bg-gradient-to-r from-purple-600 to-pink-600 hover:from-purple-700 hover:to-pink-700"
            >
              <ShoppingCart className="mr-2 h-5 w-5" />
              {isAuthenticated ? 'Beli Sekarang' : 'Login untuk Membeli'}
            </Button>

            <Button 
              variant="outline" 
              onClick={() => navigate(`/courses/${slug}`)}
              className="w-full"
            >
              <ChevronLeft className="mr-2 h-4 w-4" />
              Kembali ke Course
            </Button>
          </CardContent>
        </Card>
      </div>
    )
  }

  // Access denied - Prerequisite not met
  if (accessError?.type === 'prerequisite') {
    return (
      <div className="min-h-screen bg-gray-50 flex items-center justify-center p-4">
        <Card className="max-w-md w-full border-0 shadow-xl">
          <CardHeader className="text-center pb-6">
            <div className="mx-auto mb-6 flex h-20 w-20 items-center justify-center rounded-full bg-yellow-100">
              <Lock className="h-10 w-10 text-yellow-600" />
            </div>
            <CardTitle className="text-2xl">Lesson Terkunci</CardTitle>
            <CardDescription className="text-base mt-2">
              {accessError.message}
            </CardDescription>
          </CardHeader>
          <CardContent className="space-y-4">
            {accessError.course && (
              <div className="text-sm text-muted-foreground">
                <p>Selesaikan lesson prerequisite terlebih dahulu.</p>
              </div>
            )}
            <Button 
              variant="outline" 
              onClick={() => navigate(`/courses/${slug}`)}
              className="w-full"
            >
              <ChevronLeft className="mr-2 h-4 w-4" />
              Kembali ke Course
            </Button>
          </CardContent>
        </Card>
      </div>
    )
  }

  // Lesson not found
  if (!lesson || !course) {
    return (
      <div className="min-h-screen flex items-center justify-center">
        <div className="text-center">
          <h1 className="text-2xl font-bold mb-4">Lesson tidak ditemukan</h1>
          <Button onClick={() => navigate(`/courses/${slug}`)}>
            <ChevronLeft className="mr-2 h-4 w-4" />
            Kembali ke Course
          </Button>
        </div>
      </div>
    )
  }

  const lessonData = lesson as any
  const hasQuiz = lessonData?.quiz && lessonData.quiz.length > 0
  const hasCodeExercise = lessonData?.programming_language
  const hasContent = lessonData?.content_html || lessonData?.content

  const allLessons = course?.modules?.flatMap(m => m.lessons || []) || []
  const currentLessonItem = allLessons[currentLessonIndex]

  // Debug logging for free course access
  useEffect(() => {
    if (lessonData) {
      console.log('Lesson loaded:', {
        title: lessonData.title,
        slug: lessonData.slug,
        isFreePreview: lessonData.is_free_preview,
        hasAccess: lessonData.has_access,
        hasContent: !!hasContent,
        course: course?.title,
        courseIsPremium: course?.is_premium,
      })
    }
  }, [lessonData, course, hasContent])

  return (
    <div className="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100">
      {/* Header */}
      <header className="bg-white border-b sticky top-0 z-40 shadow-sm">
        <div className="max-w-7xl mx-auto px-4 py-4">
          <div className="flex items-center justify-between">
            <div>
              <Button 
                variant="ghost" 
                size="sm" 
                onClick={() => navigate(`/courses/${slug}`)} 
                className="mb-2 text-muted-foreground hover:text-primary"
              >
                <ChevronLeft className="h-4 w-4 mr-1" />
                Back to Course
              </Button>
              <h1 className="text-xl font-bold text-gray-900">{course.title}</h1>
              <p className="text-sm text-muted-foreground">{lessonData.title}</p>
            </div>
            <div className="flex items-center gap-2">
              <Badge 
                variant={lessonData.is_free_preview ? 'default' : 'secondary'}
                className="px-3 py-1"
              >
                {lessonData.is_free_preview ? '🆓 Free Preview' : '💎 Premium'}
              </Badge>
              <Badge variant="outline" className="px-3 py-1">
                ⏱️ {lessonData.duration_minutes} min
              </Badge>
            </div>
          </div>
        </div>
      </header>

      <div className="max-w-7xl mx-auto px-4 py-8">
        <div className="grid grid-cols-1 lg:grid-cols-3 gap-8">
          {/* Left: Main Content (2/3 width) */}
          <div className="lg:col-span-2 space-y-6">
            {/* Content Tabs */}
            {hasCodeExercise && (
              <div className="flex gap-2">
                <Button
                  variant={activeTab === 'content' ? 'default' : 'outline'}
                  onClick={() => setActiveTab('content')}
                  className="flex-1"
                >
                  <BookOpen className="h-4 w-4 mr-2" />
                  Learn
                </Button>
                <Button
                  variant={activeTab === 'exercise' ? 'default' : 'outline'}
                  onClick={() => setActiveTab('exercise')}
                  className="flex-1"
                >
                  <Code className="h-4 w-4 mr-2" />
                  Practice
                </Button>
              </div>
            )}

            {/* Lesson Content */}
            {activeTab === 'content' && (
              <Card className="border-0 shadow-lg">
                <CardHeader className="border-b bg-gradient-to-r from-blue-50 to-indigo-50">
                  <div className="flex items-center gap-3">
                    <div className="p-2 bg-blue-100 rounded-lg">
                      <BookOpen className="h-6 w-6 text-blue-600" />
                    </div>
                    <div>
                      <CardTitle className="text-2xl">Lesson Content</CardTitle>
                      <CardDescription>Read and learn the concepts</CardDescription>
                    </div>
                  </div>
                </CardHeader>
                <CardContent className="p-8">
                  <div className="lesson-content prose prose-lg max-w-none">
                    {(() => {
                      const content = lessonData?.content_html || lessonData?.content
                      if (!content) {
                        return (
                          <div className="text-center py-12">
                            <BookOpen className="h-16 w-16 mx-auto mb-4 opacity-30" />
                            <h3 className="text-xl font-semibold mb-2">Content Not Available</h3>
                            <p className="text-muted-foreground">
                              This lesson content is not available yet.
                            </p>
                            {course?.is_premium && (
                              <p className="text-sm text-muted-foreground mt-2">
                                This is a premium course. Please purchase to access the content.
                              </p>
                            )}
                          </div>
                        )
                      }
                      return (
                        <ReactMarkdown
                          remarkPlugins={[remarkGfm]}
                          rehypePlugins={[rehypeRaw]}
                          components={{
                            h1({ node, ...props }: any) {
                              return (
                                <h1 
                                  className="text-4xl font-bold text-gray-900 mb-6 pb-3 border-b-2 border-primary" 
                                  {...props} 
                                />
                              )
                            },
                            h2({ node, ...props }: any) {
                              return (
                                <h2 
                                  className="text-2xl font-bold text-gray-800 mt-8 mb-4 flex items-center gap-2" 
                                  {...props} 
                                />
                              )
                            },
                            h3({ node, ...props }: any) {
                              return (
                                <h3 
                                  className="text-xl font-semibold text-gray-800 mt-6 mb-3" 
                                  {...props} 
                                />
                              )
                            },
                            p({ node, ...props }: any) {
                              return (
                                <p 
                                  className="text-gray-700 leading-relaxed mb-4 text-lg" 
                                  {...props} 
                                />
                              )
                            },
                            ul({ node, ...props }: any) {
                              return (
                                <ul 
                                  className="list-disc list-outside ml-6 mb-4 space-y-2" 
                                  {...props} 
                                />
                              )
                            },
                            ol({ node, ...props }: any) {
                              return (
                                <ol 
                                  className="list-decimal list-outside ml-6 mb-4 space-y-2" 
                                  {...props} 
                                />
                              )
                            },
                            li({ node, ...props }: any) {
                              return (
                                <li 
                                  className="text-gray-700 leading-relaxed text-lg" 
                                  {...props} 
                                />
                              )
                            },
                            code({ node, inline, className, children, ...props }: any) {
                              const match = /language-(\w+)/.exec(className || '')
                              return !inline && match ? (
                                <div className="my-6 rounded-lg overflow-hidden shadow-lg">
                                  <SyntaxHighlighter
                                    style={vscDarkPlus}
                                    language={match[1]}
                                    PreTag="div"
                                    customStyle={{
                                      margin: 0,
                                      borderRadius: 0,
                                    }}
                                    {...props}
                                  >
                                    {String(children).replace(/\n$/, '')}
                                  </SyntaxHighlighter>
                                </div>
                              ) : (
                                <code 
                                  className="bg-gray-100 text-red-600 px-2 py-1 rounded text-sm font-mono border border-gray-200" 
                                  {...props}
                                >
                                  {children}
                                </code>
                              )
                            },
                            pre({ node, ...props }: any) {
                              return <div className="my-4" {...props} />
                            },
                            blockquote({ node, ...props }: any) {
                              return (
                                <blockquote 
                                  className="border-l-4 border-primary bg-blue-50 pl-6 pr-4 py-4 my-6 rounded-r-lg italic text-gray-700" 
                                  {...props} 
                                />
                              )
                            },
                            table({ node, ...props }: any) {
                              return (
                                <div className="my-6 overflow-x-auto">
                                  <table 
                                    className="w-full border-collapse border border-gray-300" 
                                    {...props} 
                                  />
                                </div>
                              )
                            },
                            th({ node, ...props }: any) {
                              return (
                                <th 
                                  className="border border-gray-300 bg-gray-100 px-4 py-3 text-left font-semibold" 
                                  {...props} 
                                />
                              )
                            },
                            td({ node, ...props }: any) {
                              return (
                                <td 
                                  className="border border-gray-300 px-4 py-3 text-gray-700" 
                                  {...props} 
                                />
                              )
                            },
                            hr({ node, ...props }: any) {
                              return (
                                <Separator className="my-8" {...props} />
                              )
                            },
                          }}
                        >
                          {content}
                        </ReactMarkdown>
                      )
                    })()}
                  </div>
                </CardContent>
              </Card>
            )}

            {/* Practice Tab - Code Editor */}
            {activeTab === 'exercise' && hasCodeExercise && (
              <Card className="border-0 shadow-lg">
                <CardHeader className="border-b bg-gradient-to-r from-green-50 to-emerald-50">
                  <div className="flex items-center justify-between">
                    <div className="flex items-center gap-3">
                      <div className="p-2 bg-green-100 rounded-lg">
                        <Code className="h-6 w-6 text-green-600" />
                      </div>
                      <div>
                        <CardTitle className="text-2xl">Code Practice</CardTitle>
                        <CardDescription>Write and test your code</CardDescription>
                      </div>
                    </div>
                    <div className="flex gap-2">
                      <Button
                        size="sm"
                        onClick={handleRunCode}
                        disabled={isRunning}
                        className="bg-green-600 hover:bg-green-700"
                      >
                        <Play className="h-4 w-4 mr-2" />
                        Run
                      </Button>
                      {lessonData.test_cases && lessonData.test_cases.length > 0 && (
                        <Button
                          size="sm"
                          variant="outline"
                          onClick={handleRunTests}
                          disabled={isRunning}
                        >
                          <CheckCircle className="h-4 w-4 mr-2" />
                          Run Tests
                        </Button>
                      )}
                    </div>
                  </div>
                </CardHeader>
                <CardContent className="p-6">
                  {lessonData.exercise_description && (
                    <div className="mb-6 p-4 bg-blue-50 border-l-4 border-blue-500 rounded-lg">
                      <div className="flex items-start gap-3">
                        <Lightbulb className="h-5 w-5 text-blue-600 mt-0.5" />
                        <div>
                          <h3 className="font-semibold text-blue-900 mb-1">Exercise</h3>
                          <p className="text-blue-800">{lessonData.exercise_description}</p>
                        </div>
                      </div>
                    </div>
                  )}

                  <div className="mb-4">
                    <div className="flex items-center justify-between mb-2">
                      <h3 className="font-semibold text-sm text-gray-600">Your Code</h3>
                      <Badge variant="outline" className="text-xs">
                        {lessonData.programming_language || 'plaintext'}
                      </Badge>
                    </div>
                    <textarea
                      value={code}
                      onChange={(e) => setCode(e.target.value)}
                      className="w-full h-80 font-mono text-sm bg-gray-900 text-gray-100 p-4 rounded-lg resize-none focus:outline-none focus:ring-2 focus:ring-primary border-0"
                      placeholder="Write your code here..."
                      spellCheck={false}
                    />
                  </div>

                  <div>
                    <div className="flex items-center justify-between mb-2">
                      <h3 className="font-semibold text-sm text-gray-600">Output</h3>
                      {isRunning && (
                        <div className="flex items-center gap-2 text-sm text-muted-foreground">
                          <div className="animate-spin rounded-full h-3 w-3 border-b-2 border-primary"></div>
                          Running...
                        </div>
                      )}
                    </div>
                    <div className="bg-gray-900 text-gray-100 p-4 rounded-lg min-h-[120px] max-h-60 overflow-auto font-mono text-sm">
                      {isRunning ? (
                        <div className="flex items-center gap-2">
                          <div className="animate-spin rounded-full h-4 w-4 border-b-2 border-primary"></div>
                          <span>Running...</span>
                        </div>
                      ) : output ? (
                        <pre className="whitespace-pre-wrap">{output}</pre>
                      ) : (
                        <span className="text-gray-500">Click "Run" to execute your code</span>
                      )}
                    </div>
                  </div>
                </CardContent>
              </Card>
            )}

            {/* Quiz Section */}
            {hasQuiz && !quizCompleted && activeTab === 'content' && (
              <div className="mt-8">
                <div className="mb-6">
                  <div className="flex items-center gap-3 mb-2">
                    <div className="p-2 bg-purple-100 rounded-lg">
                      <Trophy className="h-6 w-6 text-purple-600" />
                    </div>
                    <h2 className="text-2xl font-bold text-gray-900">Test Your Knowledge</h2>
                  </div>
                  <p className="text-muted-foreground">
                    Complete the quiz to reinforce what you've learned
                  </p>
                </div>
                <Quiz
                  questions={lessonData.quiz}
                  onComplete={handleQuizComplete}
                />
              </div>
            )}

            {/* Quiz Completed Summary */}
            {hasQuiz && quizCompleted && (
              <Card className="border-0 shadow-lg bg-gradient-to-r from-purple-50 to-pink-50">
                <CardContent className="p-6">
                  <div className="flex items-center justify-between">
                    <div className="flex items-center gap-4">
                      <div className="p-3 bg-purple-100 rounded-full">
                        <Trophy className="h-8 w-8 text-purple-600" />
                      </div>
                      <div>
                        <h3 className="text-xl font-bold text-gray-900">Quiz Completed!</h3>
                        <p className="text-muted-foreground">
                          You scored <span className="font-bold text-purple-600">{quizScore}</span> out of{' '}
                          <span className="font-bold">{lessonData.quiz?.length || 0}</span>
                        </p>
                      </div>
                    </div>
                    <Button
                      variant="outline"
                      onClick={() => {
                        setQuizCompleted(false)
                        setQuizScore(0)
                      }}
                    >
                      Retry Quiz
                    </Button>
                  </div>
                </CardContent>
              </Card>
            )}

            {/* Navigation Buttons */}
            <div className="flex justify-between gap-4 pt-6 border-t">
              <Button
                variant="outline"
                onClick={() => {
                  const prevLesson = allLessons[currentLessonIndex - 1]
                  if (prevLesson) {
                    navigate(`/courses/${slug}/learn/${prevLesson.slug}`)
                  }
                }}
                disabled={currentLessonIndex <= 0}
                className="flex-1 max-w-xs"
              >
                <ChevronLeft className="h-4 w-4 mr-2" />
                Previous Lesson
              </Button>
              <Button
                onClick={() => {
                  const nextLesson = allLessons[currentLessonIndex + 1]
                  if (nextLesson) {
                    navigate(`/courses/${slug}/learn/${nextLesson.slug}`)
                  }
                }}
                disabled={currentLessonIndex >= allLessons.length - 1}
                className="flex-1 max-w-xs bg-primary hover:bg-primary/90"
              >
                Next Lesson
                <ChevronRight className="h-4 w-4 ml-2" />
              </Button>
            </div>
          </div>

          {/* Right: Sidebar (1/3 width) - Progress & Info */}
          <div className="space-y-6">
            {/* Lesson Info Card */}
            <Card className="border-0 shadow-lg sticky top-24">
              <CardHeader>
                <CardTitle className="text-lg">Lesson Details</CardTitle>
              </CardHeader>
              <CardContent className="space-y-4">
                <div className="flex items-center justify-between">
                  <span className="text-sm text-muted-foreground">Duration</span>
                  <span className="font-medium">{lessonData.duration_minutes} minutes</span>
                </div>
                <Separator />
                <div className="flex items-center justify-between">
                  <span className="text-sm text-muted-foreground">Type</span>
                  <Badge variant={lessonData.is_free_preview ? 'default' : 'secondary'}>
                    {lessonData.is_free_preview ? 'Free' : 'Premium'}
                  </Badge>
                </div>
                <Separator />
                <div className="flex items-center justify-between">
                  <span className="text-sm text-muted-foreground">Language</span>
                  <span className="font-medium capitalize">
                    {lessonData.programming_language || 'N/A'}
                  </span>
                </div>
                {hasCodeExercise && (
                  <>
                    <Separator />
                    <div className="flex items-center justify-between">
                      <span className="text-sm text-muted-foreground">Exercises</span>
                      <Badge variant="outline">
                        {lessonData.test_cases?.length || 0} tests
                      </Badge>
                    </div>
                  </>
                )}
                {hasQuiz && (
                  <>
                    <Separator />
                    <div className="flex items-center justify-between">
                      <span className="text-sm text-muted-foreground">Quiz</span>
                      <Badge variant="outline">
                        {lessonData.quiz?.length || 0} questions
                      </Badge>
                    </div>
                  </>
                )}
              </CardContent>
            </Card>
          </div>
        </div>
      </div>
    </div>
  )
}
