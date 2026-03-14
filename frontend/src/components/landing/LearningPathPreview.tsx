import { Link } from "react-router-dom"
import { ArrowRight } from "lucide-react"
import type { Course } from "@/types"
import { CourseCard } from "@/components/courses/CourseCard"
import { Button } from "@/components/ui/button"

interface LearningPathPreviewProps {
  courses: Course[]
}

export function LearningPathPreview({ courses }: LearningPathPreviewProps) {
  const displayCourses = courses.slice(0, 6)

  if (displayCourses.length === 0) {
    return null
  }

  return (
    <section className="bg-muted/30 py-20 sm:py-24">
      <div className="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div className="flex flex-col items-start justify-between gap-4 sm:flex-row sm:items-end">
          <div>
            <h2 className="text-3xl font-bold tracking-tight text-foreground sm:text-4xl">
              Popular Learning Paths
            </h2>
            <p className="mt-3 text-lg text-muted-foreground">
              Start with our most popular courses chosen by thousands of learners.
            </p>
          </div>
          <Button asChild variant="ghost" className="shrink-0">
            <Link to="/courses">
              View All Courses
              <ArrowRight className="ml-2 h-4 w-4" />
            </Link>
          </Button>
        </div>

        <div className="mt-12 grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
          {displayCourses.map((course) => (
            <CourseCard key={course.id} course={course} />
          ))}
        </div>
      </div>
    </section>
  )
}
