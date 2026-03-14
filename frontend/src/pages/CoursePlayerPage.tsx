import { useState, useEffect } from 'react'
import { useParams, useNavigate } from 'react-router-dom'
import { ChevronLeft, ChevronRight, Play, CheckCircle, Code, BookOpen } from 'lucide-react'
import { useCourse } from '@/hooks/useCourses'
import { useExecuteCode, useRunTests } from '@/hooks/useCompiler'
import { Button } from '@/components/ui/button'
import { Card, CardContent } from '@/components/ui/card'
import { Badge } from '@/components/ui/badge'
import { useToast } from '@/hooks/use-toast'
import ReactMarkdown from 'react-markdown'
import { Prism as SyntaxHighlighter } from 'react-syntax-highlighter'
import { vscDarkPlus } from 'react-syntax-highlighter/dist/esm/styles/prism'

export default function CoursePlayerPage() {
  const { slug, lessonSlug } = useParams<{ slug: string; lessonSlug: string }>()
  const navigate = useNavigate()
  const { toast } = useToast()
  const { data: course, isLoading } = useCourse(slug || '')
  
  const [currentLessonIndex, setCurrentLessonIndex] = useState(0)
  const [code, setCode] = useState('')
  const [output, setOutput] = useState('')
  const [isRunning, setIsRunning] = useState(false)
  
  const executeCode = useExecuteCode()
  const runTests = useRunTests()

  useEffect(() => {
    if (course?.modules) {
      const allLessons = course.modules.flatMap(m => m.lessons || [])
      const lessonIndex = allLessons.findIndex((l: any) => l.slug === lessonSlug)
      if (lessonIndex >= 0) {
        setCurrentLessonIndex(lessonIndex)
        const lesson = allLessons[lessonIndex] as any
        if (lesson?.starter_code) {
          setCode(lesson.starter_code.replace(/\\n/g, '\n'))
        }
      }
    }
  }, [course, lessonSlug])

  const allLessons = course?.modules?.flatMap(m => m.lessons || []) || []
  const currentLesson = allLessons[currentLessonIndex]
  const prevLesson = allLessons[currentLessonIndex - 1]
  const nextLesson = allLessons[currentLessonIndex + 1]

  const handleRunCode = async () => {
    const lesson = currentLesson as any
    if (!lesson?.programming_language) return
    
    setIsRunning(true)
    try {
      const result = await executeCode.mutateAsync({
        language: lesson.programming_language,
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
    const lesson = currentLesson as any
    if (!lesson?.programming_language || !lesson?.test_cases) return
    
    setIsRunning(true)
    try {
      const result = await runTests.mutateAsync({
        language: lesson.programming_language,
        code,
        testCases: lesson.test_cases,
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

  if (isLoading) {
    return (
      <div className="min-h-screen flex items-center justify-center">
        <div className="text-center">
          <div className="animate-spin rounded-full h-12 w-12 border-b-2 border-primary mx-auto"></div>
          <p className="mt-4 text-muted-foreground">Loading course...</p>
        </div>
      </div>
    )
  }

  if (!course || !currentLesson) {
    return (
      <div className="min-h-screen flex items-center justify-center">
        <div className="text-center">
          <h1 className="text-2xl font-bold mb-4">Lesson not found</h1>
          <Button onClick={() => navigate(`/courses`)}>Browse Courses</Button>
        </div>
      </div>
    )
  }

  return (
    <div className="min-h-screen bg-gray-50">
      {/* Header */}
      <header className="bg-white border-b sticky top-0 z-40">
        <div className="max-w-7xl mx-auto px-4 py-4">
          <div className="flex items-center justify-between">
            <div>
              <Button variant="ghost" size="sm" onClick={() => navigate(`/courses/${slug}`)} className="mb-2">
                <ChevronLeft className="h-4 w-4 mr-1" />
                Back to Course
              </Button>
              <h1 className="text-xl font-bold">{course.title}</h1>
              <p className="text-sm text-muted-foreground">{currentLesson.title}</p>
            </div>
            <div className="flex items-center gap-2">
              <Badge variant={currentLesson.is_free_preview ? 'default' : 'secondary'}>
                {currentLesson.is_free_preview ? 'Free Preview' : 'Premium'}
              </Badge>
              <Badge>{currentLesson.duration_minutes} min</Badge>
            </div>
          </div>
        </div>
      </header>

      <div className="max-w-7xl mx-auto px-4 py-6">
        <div className="grid grid-cols-1 lg:grid-cols-2 gap-6">
          {/* Left: Content */}
          <div className="space-y-4">
            <Card>
              <CardContent className="p-6">
                <div className="flex items-center gap-2 mb-4">
                  <BookOpen className="h-5 w-5" />
                  <h2 className="text-lg font-semibold">Lesson Content</h2>
                </div>
                
                <div className="prose prose-sm max-w-none dark:prose-invert">
                  {(() => {
                    const lesson = currentLesson as any
                    return lesson.content_html ? (
                    <ReactMarkdown
                      components={{
                        code({ node, inline, className, children, ...props }: any) {
                          const match = /language-(\w+)/.exec(className || '')
                          return !inline && match ? (
                            <SyntaxHighlighter
                              style={vscDarkPlus}
                              language={match[1]}
                              PreTag="div"
                              {...props}
                            >
                              {String(children).replace(/\n$/, '')}
                            </SyntaxHighlighter>
                          ) : (
                            <code className={className} {...props}>
                              {children}
                            </code>
                          )
                        }
                      }}
                    >
                      {lesson.content_html}
                    </ReactMarkdown>
                  ) : (
                    <p className="text-muted-foreground">Content not available yet.</p>
                  )})()}
                </div>
              </CardContent>
            </Card>

            {/* Navigation */}
            <div className="flex justify-between gap-4">
              <Button
                variant="outline"
                onClick={() => {
                  if (prevLesson) {
                    navigate(`/courses/${slug}/learn/${prevLesson.slug}`)
                  }
                }}
                disabled={!prevLesson}
              >
                <ChevronLeft className="h-4 w-4 mr-2" />
                Previous Lesson
              </Button>
              <Button
                onClick={() => {
                  if (nextLesson) {
                    navigate(`/courses/${slug}/learn/${nextLesson.slug}`)
                  }
                }}
                disabled={!nextLesson}
              >
                Next Lesson
                <ChevronRight className="h-4 w-4 ml-2" />
              </Button>
            </div>
          </div>

          {/* Right: Code Editor & Compiler */}
          <div className="space-y-4">
            <Card>
              <CardContent className="p-4">
                <div className="flex items-center justify-between mb-4">
                  <div className="flex items-center gap-2">
                    <Code className="h-5 w-5" />
                    <h2 className="text-lg font-semibold">Code Editor</h2>
                  </div>
                  <div className="flex gap-2">
                    <Button
                      size="sm"
                      onClick={handleRunCode}
                      disabled={isRunning || !(currentLesson as any)?.programming_language}
                    >
                      <Play className="h-4 w-4 mr-2" />
                      Run
                    </Button>
                    {(() => {
                      const lesson = currentLesson as any
                      return lesson.test_cases && lesson.test_cases.length > 0 && (
                      <Button
                        size="sm"
                        variant="outline"
                        onClick={handleRunTests}
                        disabled={isRunning}
                      >
                        <CheckCircle className="h-4 w-4 mr-2" />
                        Run Tests
                      </Button>
                    )})()}
                  </div>
                </div>

                {(() => {
                  const lesson = currentLesson as any
                  return lesson.exercise_description && (
                  <div className="mb-4 p-4 bg-blue-50 border border-blue-200 rounded-lg">
                    <h3 className="font-semibold text-blue-900 mb-2">Exercise</h3>
                    <p className="text-sm text-blue-800">{lesson.exercise_description}</p>
                  </div>
                )})()}

                <textarea
                  value={code}
                  onChange={(e) => setCode(e.target.value)}
                  className="w-full h-64 font-mono text-sm bg-gray-900 text-gray-100 p-4 rounded-lg resize-none focus:outline-none focus:ring-2 focus:ring-primary"
                  placeholder="Write your code here..."
                  spellCheck={false}
                />

                <div className="mt-4">
                  <div className="flex items-center justify-between mb-2">
                    <h3 className="font-semibold text-sm">Output</h3>
                    <Badge variant="outline">
                      {(() => {
                        const lesson = currentLesson as any
                        return lesson.programming_language || 'plaintext'
                      })()}
                    </Badge>
                  </div>
                  <div className="bg-gray-900 text-gray-100 p-4 rounded-lg h-40 overflow-auto font-mono text-sm">
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
          </div>
        </div>
      </div>
    </div>
  )
}
