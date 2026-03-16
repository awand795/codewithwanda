import { useParams, useNavigate } from "react-router-dom"
import { useState } from "react"
import { useCourse } from "@/hooks/useCourses"
import { useAuthStore } from "@/stores/authStore"
import { useCertificate, useClaimCertificate } from "@/hooks/useCertificates"
import { Badge } from "@/components/ui/badge"
import { Button } from "@/components/ui/button"
import { Card, CardContent, CardHeader } from "@/components/ui/card"
import { Skeleton } from "@/components/ui/skeleton"
import { formatPrice } from "@/lib/utils"
import { CertificateDisplay } from "@/components/certificates/CertificateDisplay"
import {
  BookOpen,
  BarChart,
  Clock,
  ArrowLeft,
  PlayCircle,
  CheckCircle,
  Lock,
  Star,
  Users,
  Award,
  Zap,
  ChevronDown,
  ChevronUp,
  Download,
} from "lucide-react"

const difficultyConfig = {
  beginner: {
    label: "Beginner",
    className: "bg-gradient-to-r from-green-500 to-emerald-500 text-white",
  },
  intermediate: {
    label: "Intermediate",
    className: "bg-gradient-to-r from-yellow-500 to-orange-500 text-white",
  },
  advanced: {
    label: "Advanced",
    className: "bg-gradient-to-r from-red-500 to-pink-500 text-white",
  },
} as const

function CourseDetailSkeleton() {
  return (
    <div className="min-h-screen bg-gray-50">
      <div className="bg-gradient-to-br from-slate-900 via-blue-900 to-slate-900 py-12">
        <div className="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
          <Skeleton className="h-8 w-32 mb-8" />
          <div className="grid gap-8 lg:grid-cols-3">
            <div className="lg:col-span-2 space-y-6">
              <Skeleton className="h-12 w-3/4" />
              <Skeleton className="h-6 w-full" />
              <Skeleton className="h-6 w-5/6" />
            </div>
            <div className="space-y-4">
              <Skeleton className="h-64 w-full rounded-xl" />
            </div>
          </div>
        </div>
      </div>
    </div>
  )
}

export default function CourseDetailPage() {
  const { slug } = useParams<{ slug: string }>()
  const navigate = useNavigate()
  const { data: course, isLoading } = useCourse(slug || '')
  const { isAuthenticated } = useAuthStore()
  const [expandedModules, setExpandedModules] = useState<number[]>([0])

  // Certificate hooks
  const { data: certificateData } = useCertificate(course?.id || 0)
  const claimCertificate = useClaimCertificate(course?.id || 0)

  const handleDownloadCertificate = () => {
    if (course?.id) {
      window.open(`/api/courses/${course.id}/certificate/download`, '_blank')
    }
  }

  if (isLoading) {
    return <CourseDetailSkeleton />
  }

  if (!course) {
    return (
      <div className="min-h-screen flex items-center justify-center">
        <div className="text-center">
          <h1 className="text-2xl font-bold mb-4">Course not found</h1>
          <Button onClick={() => navigate('/courses')}>Browse Courses</Button>
        </div>
      </div>
    )
  }

  const difficulty = difficultyConfig[course.difficulty]
  const totalLessons = course.modules?.reduce((sum, m) => sum + (m.lessons?.length || 0), 0) || 0
  const totalDuration = course.modules?.reduce((sum, m) => 
    sum + (m.lessons?.reduce((s, l) => s + (l.duration_minutes || 0), 0) || 0), 0
  ) || 0

  const toggleModule = (index: number) => {
    setExpandedModules(prev => 
      prev.includes(index) ? prev.filter(i => i !== index) : [...prev, index]
    )
  }

  const handleStartLearning = () => {
    if (course.last_accessed_lesson) {
      // Continue from last accessed lesson
      navigate(`/courses/${slug}/learn/${course.last_accessed_lesson.slug}`)
    } else if (course.modules && course.modules.length > 0 && course.modules[0].lessons && course.modules[0].lessons.length > 0) {
      // Start from first lesson
      const firstLesson = course.modules[0].lessons[0]
      navigate(`/courses/${slug}/learn/${firstLesson.slug}`)
    }
  }

  return (
    <div className="min-h-screen bg-gray-50">
      {/* Header */}
      <div className="bg-gradient-to-br from-slate-900 via-blue-900 to-slate-900 text-white">
        <div className="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-8">
          <Button 
            variant="ghost" 
            onClick={() => navigate('/courses')}
            className="mb-6 text-white/80 hover:text-white hover:bg-white/10"
          >
            <ArrowLeft className="h-4 w-4 mr-2" />
            Back to Courses
          </Button>

          <div className="grid gap-8 lg:grid-cols-3">
            <div className="lg:col-span-2 space-y-6">
              <div className="flex flex-wrap gap-3">
                <Badge className={difficulty.className}>
                  {difficulty.label}
                </Badge>
                {course.category && (
                  <Badge variant="secondary" className="bg-white/10 text-white">
                    {course.category.name}
                  </Badge>
                )}
                {course.is_premium ? (
                  <Badge className="bg-gradient-to-r from-amber-500 to-orange-500 text-white">
                    <Zap className="h-3 w-3 mr-1" />
                    Premium
                  </Badge>
                ) : (
                  <Badge className="bg-gradient-to-r from-green-500 to-emerald-500 text-white">
                    <Star className="h-3 w-3 mr-1" />
                    Free
                  </Badge>
                )}
              </div>

              <h1 className="text-3xl sm:text-4xl lg:text-5xl font-bold leading-tight">
                {course.title}
              </h1>

              {course.description && (
                <p className="text-lg text-gray-300 leading-relaxed">
                  {course.description}
                </p>
              )}

              {/* Stats */}
              <div className="flex flex-wrap gap-6 pt-4">
                <div className="flex items-center gap-2">
                  <BarChart className="h-5 w-5 text-blue-400" />
                  <div>
                    <div className="font-semibold">{course.modules_count || 0}</div>
                    <div className="text-sm text-gray-400">Modules</div>
                  </div>
                </div>
                <div className="flex items-center gap-2">
                  <BookOpen className="h-5 w-5 text-blue-400" />
                  <div>
                    <div className="font-semibold">{totalLessons}</div>
                    <div className="text-sm text-gray-400">Lessons</div>
                  </div>
                </div>
                <div className="flex items-center gap-2">
                  <Clock className="h-5 w-5 text-blue-400" />
                  <div>
                    <div className="font-semibold">{Math.ceil(totalDuration / 60)}h {totalDuration % 60}m</div>
                    <div className="text-sm text-gray-400">Duration</div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      {/* Main Content */}
      <div className="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-12">
        <div className="grid gap-8 lg:grid-cols-3">
          {/* Left: Course Content */}
          <div className="lg:col-span-2 space-y-8">
            {/* What You'll Learn */}
            <Card className="border-0 shadow-lg">
              <CardHeader>
                <h2 className="text-2xl font-bold">What You'll Learn</h2>
              </CardHeader>
              <CardContent>
                <div className="grid gap-3 sm:grid-cols-2">
                  {[
                    'Build responsive websites with HTML5 and CSS3',
                    'Master JavaScript fundamentals and ES6+ features',
                    'Create interactive web applications',
                    'Understand modern web development workflows',
                    'Deploy applications to production',
                    'Best practices and industry standards',
                  ].map((item, index) => (
                    <div key={index} className="flex items-start gap-3">
                      <CheckCircle className="h-5 w-5 text-green-500 shrink-0 mt-0.5" />
                      <span className="text-gray-700">{item}</span>
                    </div>
                  ))}
                </div>
              </CardContent>
            </Card>

            {/* Curriculum */}
            <Card className="border-0 shadow-lg">
              <CardHeader>
                <h2 className="text-2xl font-bold">Course Curriculum</h2>
                <p className="text-muted-foreground">
                  {course.modules_count} modules • {totalLessons} lessons • {Math.ceil(totalDuration / 60)}h {totalDuration % 60}m total length
                </p>
              </CardHeader>
              <CardContent className="space-y-3">
                {course.modules?.map((module, moduleIndex) => (
                  <div 
                    key={module.id} 
                    className="border rounded-lg overflow-hidden"
                  >
                    <button
                      onClick={() => toggleModule(moduleIndex)}
                      className="w-full flex items-center justify-between p-4 bg-gray-50 hover:bg-gray-100 transition-colors"
                    >
                      <div className="flex items-center gap-3">
                        <div className="h-8 w-8 rounded-full bg-primary text-primary-foreground flex items-center justify-center text-sm font-semibold">
                          {moduleIndex + 1}
                        </div>
                        <div className="text-left">
                          <h3 className="font-semibold">{module.title}</h3>
                          <p className="text-sm text-muted-foreground">
                            {module.lessons?.length || 0} lessons • {module.lessons?.reduce((sum, l) => sum + (l.duration_minutes || 0), 0)} min
                          </p>
                        </div>
                      </div>
                      {expandedModules.includes(moduleIndex) ? (
                        <ChevronUp className="h-5 w-5 text-gray-400" />
                      ) : (
                        <ChevronDown className="h-5 w-5 text-gray-400" />
                      )}
                    </button>

                    {expandedModules.includes(moduleIndex) && (
                      <div className="divide-y">
                        {module.lessons?.map((lesson, lessonIndex) => (
                          <div 
                            key={lesson.id}
                            className="flex items-center justify-between p-4 hover:bg-gray-50 transition-colors"
                          >
                            <div className="flex items-center gap-3 flex-1">
                              <div className="text-sm text-gray-500 w-6">
                                {lessonIndex + 1}
                              </div>
                              <div className="flex-1">
                                <h4 className="font-medium">{lesson.title}</h4>
                                <div className="flex items-center gap-3 text-sm text-gray-500">
                                  <span className="flex items-center gap-1">
                                    <Clock className="h-3 w-3" />
                                    {lesson.duration_minutes} min
                                  </span>
                                  {lesson.is_free_preview && (
                                    <Badge variant="secondary" className="text-xs">
                                      <PlayCircle className="h-3 w-3 mr-1" />
                                      Free Preview
                                    </Badge>
                                  )}
                                </div>
                              </div>
                            </div>
                            <Button
                              size="sm"
                              onClick={() => navigate(`/courses/${slug}/learn/${lesson.slug}`)}
                              className="shrink-0"
                            >
                              {lesson.is_free_preview ? (
                                <>
                                  <PlayCircle className="h-4 w-4 mr-1" />
                                  Start
                                </>
                              ) : (
                                <>
                                  <Lock className="h-4 w-4 mr-1" />
                                  Unlock
                                </>
                              )}
                            </Button>
                          </div>
                        ))}
                      </div>
                    )}
                  </div>
                ))}
              </CardContent>
            </Card>

            {/* Certificate Section */}
            {isAuthenticated && course.user_progress && course.user_progress.percentage > 0 && (
              <CertificateDisplay
                courseId={course.id}
                certificate={certificateData?.certificate}
                eligibility={certificateData?.eligibility}
                hasCertificate={certificateData?.has_certificate || false}
                onClaim={() => claimCertificate.mutate()}
                onDownload={handleDownloadCertificate}
                isClaiming={claimCertificate.isPending}
              />
            )}
          </div>

          {/* Right: Sidebar */}
          <div className="space-y-6">
            <Card className="border-0 shadow-xl sticky top-24">
              <CardContent className="p-6 space-y-6">
                {/* Thumbnail */}
                <div className="aspect-video rounded-lg overflow-hidden bg-gradient-to-br from-blue-600 via-purple-600 to-pink-600 flex items-center justify-center">
                  {course.thumbnail ? (
                    <img 
                      src={course.thumbnail} 
                      alt={course.title}
                      className="w-full h-full object-cover"
                    />
                  ) : (
                    <BookOpen className="h-16 w-16 text-white/50" />
                  )}
                </div>

                {/* Price */}
                <div className="text-center">
                  {course.is_premium ? (
                    <>
                      <div className="text-3xl font-bold mb-1">
                        {formatPrice(course.price)}
                      </div>
                      <p className="text-sm text-muted-foreground">One-time payment</p>
                    </>
                  ) : (
                    <div className="text-3xl font-bold text-green-600">
                      Free
                    </div>
                  )}
                </div>

                {/* CTA Buttons */}
                <div className="space-y-3">
                  {course.user_progress && course.user_progress.percentage > 0 ? (
                    <>
                      <div className="space-y-2">
                        <div className="flex items-center justify-between text-sm">
                          <span className="text-muted-foreground">Your Progress</span>
                          <span className="font-semibold text-primary">{course.user_progress.percentage}%</span>
                        </div>
                        <div className="w-full bg-gray-200 rounded-full h-2">
                          <div 
                            className="bg-gradient-to-r from-green-400 to-emerald-500 h-2 rounded-full transition-all duration-300"
                            style={{ width: `${course.user_progress.percentage}%` }}
                          />
                        </div>
                        <div className="text-xs text-muted-foreground">
                          {course.user_progress.completed} of {course.user_progress.total} lessons completed
                        </div>
                      </div>
                      <Button
                        className="w-full h-12 text-lg bg-gradient-to-r from-green-600 to-emerald-600 hover:from-green-700 hover:to-emerald-700"
                        onClick={handleStartLearning}
                      >
                        <PlayCircle className="h-5 w-5 mr-2" />
                        Continue Learning
                      </Button>
                      {course.last_accessed_lesson && (
                        <div className="text-xs text-center text-muted-foreground">
                          Last: {course.last_accessed_lesson.title}
                        </div>
                      )}
                    </>
                  ) : (
                    <>
                      <Button
                        className="w-full h-12 text-lg bg-gradient-to-r from-blue-600 to-cyan-600 hover:from-blue-700 hover:to-cyan-700"
                        onClick={handleStartLearning}
                      >
                        <PlayCircle className="h-5 w-5 mr-2" />
                        Start Learning
                      </Button>
                      {!isAuthenticated && (
                        <Button
                          variant="outline"
                          className="w-full h-12"
                          onClick={() => navigate('/register')}
                        >
                          <Users className="h-5 w-5 mr-2" />
                          Sign Up to Enroll
                        </Button>
                      )}
                    </>
                  )}
                </div>

                {/* Features */}
                <div className="space-y-3 pt-4 border-t">
                  <div className="flex items-center gap-3 text-sm">
                    <Award className="h-5 w-5 text-primary" />
                    <span>Certificate of completion</span>
                  </div>
                  <div className="flex items-center gap-3 text-sm">
                    <BookOpen className="h-5 w-5 text-primary" />
                    <span>Lifetime access</span>
                  </div>
                  <div className="flex items-center gap-3 text-sm">
                    <Zap className="h-5 w-5 text-primary" />
                    <span>Interactive exercises</span>
                  </div>
                  <div className="flex items-center gap-3 text-sm">
                    <Users className="h-5 w-5 text-primary" />
                    <span>Community support</span>
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
