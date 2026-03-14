import { Link } from "react-router-dom"
import { Lock, ArrowRight, ShoppingCart } from "lucide-react"
import { Button } from "@/components/ui/button"
import { Card, CardContent, CardHeader, CardTitle } from "@/components/ui/card"
import type { LessonSummary } from "@/types"

interface PrerequisiteGateProps {
  prerequisites: LessonSummary[]
  courseName?: string
  courseSlug?: string
  type: "prerequisite" | "purchase"
}

export function PrerequisiteGate({
  prerequisites,
  courseName,
  courseSlug,
  type,
}: PrerequisiteGateProps) {
  if (type === "purchase") {
    return (
      <Card className="border-amber-200 bg-amber-50/50">
        <CardHeader className="pb-3">
          <div className="flex items-center gap-2">
            <div className="flex h-8 w-8 items-center justify-center rounded-full bg-amber-100">
              <Lock className="h-4 w-4 text-amber-600" />
            </div>
            <CardTitle className="text-lg text-amber-900">
              Premium Content
            </CardTitle>
          </div>
        </CardHeader>
        <CardContent className="space-y-4">
          <p className="text-sm text-amber-800">
            This lesson is part of the premium course
            {courseName ? (
              <span className="font-semibold"> "{courseName}"</span>
            ) : null}
            . Purchase the course to unlock all lessons.
          </p>
          {courseSlug && (
            <Button asChild className="gap-2">
              <Link to={`/courses/${courseSlug}`}>
                <ShoppingCart className="h-4 w-4" />
                View Course
              </Link>
            </Button>
          )}
        </CardContent>
      </Card>
    )
  }

  return (
    <Card className="border-amber-200 bg-amber-50/50">
      <CardHeader className="pb-3">
        <div className="flex items-center gap-2">
          <div className="flex h-8 w-8 items-center justify-center rounded-full bg-amber-100">
            <Lock className="h-4 w-4 text-amber-600" />
          </div>
          <CardTitle className="text-lg text-amber-900">
            Prerequisites Required
          </CardTitle>
        </div>
      </CardHeader>
      <CardContent className="space-y-4">
        <p className="text-sm text-amber-800">
          You need to complete the following lessons before accessing this
          content:
        </p>
        <ul className="space-y-2">
          {prerequisites.map((lesson) => (
            <li key={lesson.id}>
              <Link
                to={`/lessons/${lesson.slug}`}
                className="inline-flex items-center gap-2 text-sm font-medium text-primary hover:underline underline-offset-4"
              >
                <ArrowRight className="h-3 w-3" />
                {lesson.title}
              </Link>
            </li>
          ))}
        </ul>
      </CardContent>
    </Card>
  )
}
