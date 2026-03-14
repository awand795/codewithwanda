import { useParams, Link } from "react-router-dom"
import { useCourse } from "@/hooks/useCourses"
import { useCourseSummary } from "@/hooks/useProgress"
import { useAuthStore } from "@/stores/authStore"
import { CourseSyllabus } from "@/components/courses/CourseSyllabus"
import { Badge } from "@/components/ui/badge"
import { Button } from "@/components/ui/button"
import {
  Card,
  CardContent,
  CardFooter,
  CardHeader,
  CardTitle,
} from "@/components/ui/card"
import { Progress } from "@/components/ui/progress"
import { Skeleton } from "@/components/ui/skeleton"
import { formatPrice } from "@/lib/utils"
import {
  BookOpen,
  BarChart,
  Clock,
  Layers,
  ArrowLeft,
  ShoppingCart,
} from "lucide-react"

const difficultyConfig = {
  beginner: {
    label: "Beginner",
    className: "bg-green-100 text-green-800 border-green-200",
  },
  intermediate: {
    label: "Intermediate",
    className: "bg-yellow-100 text-yellow-800 border-yellow-200",
  },
  advanced: {
    label: "Advanced",
    className: "bg-red-100 text-red-800 border-red-200",
  },
} as const

function CourseDetailSkeleton() {
  return (
    <div className="mx-auto max-w-7xl px-4 py-12 sm:px-6 lg:px-8">
      <Skeleton className="h-5 w-32 mb-8" />
      <div className="grid gap-8 lg:grid-cols-3">
        <div className="lg:col-span-2 space-y-6">
          <div className="space-y-3">
            <div className="flex gap-2">
              <Skeleton className="h-5 w-20" />
              <Skeleton className="h-5 w-24" />
            </div>
            <Skeleton className="h-10 w-full" />
            <Skeleton className="h-10 w-3/4" />
            <Skeleton className="h-5 w-full" />
            <Skeleton className="h-5 w-2/3" />
          </div>
          <div className="space-y-3 pt-4">
            <Skeleton className="h-7 w-40" />
            {Array.from({ length: 4 }).map((_, i) => (
              <Skeleton key={i} className="h-16 w-full rounded-lg" />
            ))}
          </div>
        </div>
        <div>
          <Skeleton className="h-72 w-full rounded-xl" />
        </div>
      </div>
    </div>
  )
}

export default function CourseDetailPage() {
  const { slug } = useParams<{ slug: string }>()
  const { data: course, isLoading, error } = useCourse(slug ?? "")
  const { isAuthenticated } = useAuthStore()
  const {
    data: progressSummary,
    isLoading: isProgressLoading,
  } = useCourseSummary(course?.id ?? 0)

  if (isLoading) {
    return <CourseDetailSkeleton />
  }

  if (error || !course) {
    return (
      <div className="mx-auto max-w-7xl px-4 py-12 sm:px-6 lg:px-8">
        <div className="text-center py-16">
          <BookOpen className="mx-auto h-16 w-16 text-muted-foreground/40 mb-4" />
          <h2 className="text-2xl font-bold text-foreground mb-2">
            Course Not Found
          </h2>
          <p className="text-muted-foreground mb-6">
            The course you are looking for does not exist or has been removed.
          </p>
          <Button asChild>
            <Link to="/courses">
              <ArrowLeft className="mr-2 h-4 w-4" />
              Back to Courses
            </Link>
          </Button>
        </div>
      </div>
    )
  }

  const difficulty = difficultyConfig[course.difficulty]

  return (
    <div className="mx-auto max-w-7xl px-4 py-12 sm:px-6 lg:px-8">
      {/* Breadcrumb */}
      <div className="mb-8">
        <Link
          to="/courses"
          className="inline-flex items-center gap-1 text-sm text-muted-foreground hover:text-primary transition-colors"
        >
          <ArrowLeft className="h-4 w-4" />
          Back to Courses
        </Link>
      </div>

      <div className="grid gap-8 lg:grid-cols-3">
        {/* Main Content */}
        <div className="lg:col-span-2 space-y-8">
          {/* Course Header */}
          <div>
            <div className="flex flex-wrap items-center gap-2 mb-3">
              <Badge variant="outline" className={difficulty.className}>
                {difficulty.label}
              </Badge>
              {course.category && (
                <Badge variant="secondary">{course.category.name}</Badge>
              )}
              {course.is_premium ? (
                <Badge className="bg-primary text-primary-foreground">
                  Premium
                </Badge>
              ) : (
                <Badge className="bg-green-600 text-white border-green-600">
                  Free
                </Badge>
              )}
            </div>

            <h1 className="text-3xl font-bold tracking-tight text-foreground sm:text-4xl">
              {course.title}
            </h1>

            {course.description && (
              <p className="mt-4 text-lg leading-relaxed text-muted-foreground">
                {course.description}
              </p>
            )}

            {/* Course stats */}
            <div className="mt-6 flex flex-wrap items-center gap-6 text-sm text-muted-foreground">
              {course.modules_count !== undefined && (
                <div className="flex items-center gap-1.5">
                  <Layers className="h-4 w-4" />
                  <span>{course.modules_count} modules</span>
                </div>
              )}
              {course.lessons_count !== undefined && (
                <div className="flex items-center gap-1.5">
                  <Clock className="h-4 w-4" />
                  <span>{course.lessons_count} lessons</span>
                </div>
              )}
              <div className="flex items-center gap-1.5">
                <BarChart className="h-4 w-4" />
                <span>{difficulty.label} level</span>
              </div>
            </div>
          </div>

          {/* Progress Summary (if authenticated and has progress) */}
          {isAuthenticated && !isProgressLoading && progressSummary && progressSummary.total > 0 && (
            <Card>
              <CardHeader className="pb-3">
                <CardTitle className="text-lg">Your Progress</CardTitle>
              </CardHeader>
              <CardContent className="space-y-3">
                <Progress value={progressSummary.percentage} />
                <p className="text-sm text-muted-foreground">
                  {progressSummary.completed} of {progressSummary.total} lessons
                  completed ({progressSummary.percentage}%)
                </p>
              </CardContent>
            </Card>
          )}

          {/* Syllabus */}
          <div>
            <h2 className="text-2xl font-bold tracking-tight text-foreground mb-4">
              Course Syllabus
            </h2>
            <CourseSyllabus modules={course.modules ?? []} />
          </div>
        </div>

        {/* Sidebar - Pricing Card */}
        <div>
          <div className="sticky top-24">
            <Card className="overflow-hidden">
              {/* Thumbnail */}
              <div className="aspect-video bg-gradient-to-br from-primary/80 to-primary/40 flex items-center justify-center">
                <BookOpen className="h-16 w-16 text-white/70" />
              </div>

              <CardHeader>
                <CardTitle className="text-3xl">
                  {course.is_premium ? formatPrice(course.price) : "Free"}
                </CardTitle>
              </CardHeader>

              <CardContent className="space-y-4">
                <ul className="space-y-2 text-sm text-muted-foreground">
                  {course.modules_count !== undefined && (
                    <li className="flex items-center gap-2">
                      <Layers className="h-4 w-4 text-primary" />
                      {course.modules_count} modules
                    </li>
                  )}
                  {course.lessons_count !== undefined && (
                    <li className="flex items-center gap-2">
                      <Clock className="h-4 w-4 text-primary" />
                      {course.lessons_count} lessons
                    </li>
                  )}
                  <li className="flex items-center gap-2">
                    <BarChart className="h-4 w-4 text-primary" />
                    {difficulty.label} level
                  </li>
                </ul>
              </CardContent>

              <CardFooter className="flex flex-col gap-3">
                {course.is_premium ? (
                  isAuthenticated ? (
                    <Button className="w-full" size="lg">
                      <ShoppingCart className="mr-2 h-4 w-4" />
                      Purchase Course
                    </Button>
                  ) : (
                    <Button asChild className="w-full" size="lg">
                      <Link to="/login">Login to Purchase</Link>
                    </Button>
                  )
                ) : (
                  <Button asChild className="w-full" size="lg">
                    <Link
                      to={
                        course.modules?.[0]?.lessons?.[0]
                          ? `/lessons/${course.modules[0].lessons[0].slug}`
                          : "#"
                      }
                    >
                      Start Learning
                    </Link>
                  </Button>
                )}
              </CardFooter>
            </Card>
          </div>
        </div>
      </div>
    </div>
  )
}
