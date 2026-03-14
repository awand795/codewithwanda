import { Link } from "react-router-dom"
import { BookOpen, Clock, BarChart } from "lucide-react"
import { Card, CardContent, CardFooter, CardHeader } from "@/components/ui/card"
import { Badge } from "@/components/ui/badge"
import { formatPrice } from "@/lib/utils"
import type { Course } from "@/types"

const difficultyConfig = {
  beginner: { label: "Beginner", className: "bg-green-100 text-green-800 border-green-200" },
  intermediate: { label: "Intermediate", className: "bg-yellow-100 text-yellow-800 border-yellow-200" },
  advanced: { label: "Advanced", className: "bg-red-100 text-red-800 border-red-200" },
} as const

interface CourseCardProps {
  course: Course
}

export function CourseCard({ course }: CourseCardProps) {
  const difficulty = difficultyConfig[course.difficulty]

  return (
    <Link to={`/courses/${course.slug}`} className="group block">
      <Card className="h-full overflow-hidden transition-shadow hover:shadow-lg">
        {/* Thumbnail placeholder */}
        <div className="relative aspect-video bg-gradient-to-br from-primary/80 to-primary/40 flex items-center justify-center">
          <BookOpen className="h-12 w-12 text-white/70" />
          {/* Price badge */}
          <div className="absolute top-3 right-3">
            {course.is_premium ? (
              <Badge className="bg-primary text-primary-foreground">
                {formatPrice(course.price)}
              </Badge>
            ) : (
              <Badge className="bg-green-600 text-white border-green-600">
                Free
              </Badge>
            )}
          </div>
        </div>

        <CardHeader className="pb-2">
          <div className="flex items-center gap-2 mb-1">
            <Badge variant="outline" className={difficulty.className}>
              {difficulty.label}
            </Badge>
            {course.category && (
              <Badge variant="secondary" className="text-xs">
                {course.category.name}
              </Badge>
            )}
          </div>
          <h3 className="font-semibold text-lg leading-tight line-clamp-2 group-hover:text-primary transition-colors">
            {course.title}
          </h3>
        </CardHeader>

        <CardContent className="pb-2">
          {course.description && (
            <p className="text-sm text-muted-foreground line-clamp-2">
              {course.description}
            </p>
          )}
        </CardContent>

        <CardFooter className="text-sm text-muted-foreground gap-4">
          {course.modules_count !== undefined && (
            <div className="flex items-center gap-1">
              <BarChart className="h-4 w-4" />
              <span>{course.modules_count} modules</span>
            </div>
          )}
          {course.lessons_count !== undefined && (
            <div className="flex items-center gap-1">
              <Clock className="h-4 w-4" />
              <span>{course.lessons_count} lessons</span>
            </div>
          )}
        </CardFooter>
      </Card>
    </Link>
  )
}
