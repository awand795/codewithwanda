import { Link } from "react-router-dom"
import { ChevronLeft, ChevronRight } from "lucide-react"
import { Button } from "@/components/ui/button"
import type { Module, LessonSummary } from "@/types"

interface LessonNavigationProps {
  modules: Module[]
  currentLessonSlug: string
}

export function LessonNavigation({ modules, currentLessonSlug }: LessonNavigationProps) {
  // Flatten all lessons across modules in order
  const allLessons: LessonSummary[] = modules
    .sort((a, b) => a.order - b.order)
    .flatMap((m) => (m.lessons ?? []).sort((a, b) => a.order - b.order))

  const currentIndex = allLessons.findIndex((l) => l.slug === currentLessonSlug)

  if (currentIndex === -1) return null

  const prevLesson = currentIndex > 0 ? allLessons[currentIndex - 1] : null
  const nextLesson =
    currentIndex < allLessons.length - 1 ? allLessons[currentIndex + 1] : null

  return (
    <div className="flex items-center justify-between gap-4 pt-6 border-t">
      {prevLesson ? (
        <Button variant="outline" asChild className="gap-2 max-w-[45%]">
          <Link to={`/lessons/${prevLesson.slug}`}>
            <ChevronLeft className="h-4 w-4 shrink-0" />
            <span className="truncate">{prevLesson.title}</span>
          </Link>
        </Button>
      ) : (
        <div />
      )}

      {nextLesson ? (
        <Button variant="outline" asChild className="gap-2 max-w-[45%] ml-auto">
          <Link to={`/lessons/${nextLesson.slug}`}>
            <span className="truncate">{nextLesson.title}</span>
            <ChevronRight className="h-4 w-4 shrink-0" />
          </Link>
        </Button>
      ) : (
        <div />
      )}
    </div>
  )
}
