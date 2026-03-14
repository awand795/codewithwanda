import { useParams, Link } from "react-router-dom"
import { useLesson } from "@/hooks/useLessons"
import { useMarkLessonComplete } from "@/hooks/useProgress"
import { useAuthStore } from "@/stores/authStore"
import { LessonContent } from "@/components/lessons/LessonContent"
import { LessonVideo } from "@/components/lessons/LessonVideo"
import { Button } from "@/components/ui/button"
import {
  Card,
  CardContent,
  CardDescription,
  CardFooter,
  CardHeader,
  CardTitle,
} from "@/components/ui/card"
import { Skeleton } from "@/components/ui/skeleton"
import {
  AlertTriangle,
  ArrowLeft,
  CheckCircle2,
  Lock,
  ShoppingCart,
} from "lucide-react"
import type { AxiosError } from "axios"
import type { LessonSummary } from "@/types"

interface ErrorResponseData {
  message?: string
  type?: "prerequisite" | "purchase_required"
  prerequisites?: LessonSummary[]
}

function LessonSkeleton() {
  return (
    <div className="mx-auto max-w-4xl px-4 py-12 sm:px-6 lg:px-8">
      <Skeleton className="h-5 w-32 mb-8" />
      <Skeleton className="aspect-video w-full rounded-lg mb-8" />
      <div className="space-y-4">
        <Skeleton className="h-9 w-3/4" />
        <Skeleton className="h-5 w-full" />
        <Skeleton className="h-5 w-full" />
        <Skeleton className="h-5 w-2/3" />
      </div>
    </div>
  )
}

function PrerequisiteGate({
  prerequisites,
  message,
}: {
  prerequisites?: LessonSummary[]
  message: string
}) {
  return (
    <div className="mx-auto max-w-2xl px-4 py-12 sm:px-6 lg:px-8">
      <Card>
        <CardHeader className="text-center">
          <div className="mx-auto mb-4 flex h-16 w-16 items-center justify-center rounded-full bg-yellow-100">
            <Lock className="h-8 w-8 text-yellow-600" />
          </div>
          <CardTitle className="text-2xl">Lesson Locked</CardTitle>
          <CardDescription className="text-base">{message}</CardDescription>
        </CardHeader>

        {prerequisites && prerequisites.length > 0 && (
          <CardContent>
            <h4 className="mb-3 font-medium text-sm text-muted-foreground">
              Complete these lessons first:
            </h4>
            <ul className="space-y-2">
              {prerequisites.map((prereq) => (
                <li key={prereq.id}>
                  <Link
                    to={`/lessons/${prereq.slug}`}
                    className="flex items-center gap-2 rounded-md border p-3 text-sm hover:bg-muted/50 transition-colors"
                  >
                    <AlertTriangle className="h-4 w-4 text-yellow-500 shrink-0" />
                    <span className="font-medium">{prereq.title}</span>
                  </Link>
                </li>
              ))}
            </ul>
          </CardContent>
        )}

        <CardFooter>
          <Button asChild variant="outline" className="w-full">
            <Link to="/courses">
              <ArrowLeft className="mr-2 h-4 w-4" />
              Back to Courses
            </Link>
          </Button>
        </CardFooter>
      </Card>
    </div>
  )
}

function PurchaseGate({ message }: { message: string }) {
  const { isAuthenticated } = useAuthStore()

  return (
    <div className="mx-auto max-w-2xl px-4 py-12 sm:px-6 lg:px-8">
      <Card>
        <CardHeader className="text-center">
          <div className="mx-auto mb-4 flex h-16 w-16 items-center justify-center rounded-full bg-primary/10">
            <ShoppingCart className="h-8 w-8 text-primary" />
          </div>
          <CardTitle className="text-2xl">Purchase Required</CardTitle>
          <CardDescription className="text-base">{message}</CardDescription>
        </CardHeader>

        <CardFooter className="flex flex-col gap-3">
          {isAuthenticated ? (
            <Button asChild className="w-full">
              <Link to="/courses">Browse Courses</Link>
            </Button>
          ) : (
            <Button asChild className="w-full">
              <Link to="/login">Login to Purchase</Link>
            </Button>
          )}
          <Button asChild variant="outline" className="w-full">
            <Link to="/courses">
              <ArrowLeft className="mr-2 h-4 w-4" />
              Back to Courses
            </Link>
          </Button>
        </CardFooter>
      </Card>
    </div>
  )
}

export default function LessonPage() {
  const { slug } = useParams<{ slug: string }>()
  const { data: lesson, isLoading, error } = useLesson(slug ?? "")
  const markComplete = useMarkLessonComplete()

  const axiosError = error as AxiosError<ErrorResponseData> | null

  if (isLoading) {
    return <LessonSkeleton />
  }

  // Handle 403 errors
  if (axiosError?.response?.status === 403) {
    const errorData = axiosError.response.data
    const errorType = errorData?.type

    if (errorType === "purchase_required") {
      return (
        <PurchaseGate
          message={
            errorData?.message ??
            "You need to purchase this course to access this lesson."
          }
        />
      )
    }

    // Default 403: prerequisite gate
    return (
      <PrerequisiteGate
        prerequisites={errorData?.prerequisites}
        message={
          errorData?.message ??
          "You need to complete prerequisite lessons before accessing this content."
        }
      />
    )
  }

  // Generic error
  if (error || !lesson) {
    return (
      <div className="mx-auto max-w-4xl px-4 py-12 sm:px-6 lg:px-8">
        <div className="text-center py-16">
          <AlertTriangle className="mx-auto h-16 w-16 text-muted-foreground/40 mb-4" />
          <h2 className="text-2xl font-bold text-foreground mb-2">
            Lesson Not Found
          </h2>
          <p className="text-muted-foreground mb-6">
            The lesson you are looking for does not exist or has been removed.
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

  const handleMarkComplete = () => {
    markComplete.mutate(lesson.id)
  }

  return (
    <div className="mx-auto max-w-4xl px-4 py-12 sm:px-6 lg:px-8">
      {/* Back link */}
      <div className="mb-8">
        <Link
          to="/courses"
          className="inline-flex items-center gap-1 text-sm text-muted-foreground hover:text-primary transition-colors"
        >
          <ArrowLeft className="h-4 w-4" />
          Back to Courses
        </Link>
      </div>

      {/* Video */}
      {lesson.video_url && (
        <div className="mb-8">
          <LessonVideo videoUrl={lesson.video_url} />
        </div>
      )}

      {/* Lesson title */}
      <h1 className="text-3xl font-bold tracking-tight text-foreground mb-6">
        {lesson.title}
      </h1>

      {/* Lesson content */}
      {lesson.content && (
        <div className="mb-8">
          <LessonContent content={lesson.content} />
        </div>
      )}

      {/* Mark as Complete button */}
      <div className="mt-10 flex items-center justify-between border-t pt-6">
        <div />
        <Button
          onClick={handleMarkComplete}
          disabled={markComplete.isPending}
          size="lg"
          className={markComplete.isSuccess ? "bg-green-600 hover:bg-green-700" : ""}
        >
          {markComplete.isSuccess ? (
            <>
              <CheckCircle2 className="mr-2 h-4 w-4" />
              Completed!
            </>
          ) : markComplete.isPending ? (
            "Marking..."
          ) : (
            <>
              <CheckCircle2 className="mr-2 h-4 w-4" />
              Mark as Complete
            </>
          )}
        </Button>
      </div>
    </div>
  )
}
