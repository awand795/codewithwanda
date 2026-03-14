import { Link } from "react-router-dom"
import { BookOpen, BarChart, Layers } from "lucide-react"
import { Card, CardContent, CardFooter, CardHeader, CardTitle } from "@/components/ui/card"
import { Button } from "@/components/ui/button"
import { Badge } from "@/components/ui/badge"
import { formatPrice } from "@/lib/utils"
import type { Course } from "@/types"

const difficultyConfig = {
  beginner: { label: "Beginner", className: "bg-green-100 text-green-800 border-green-200" },
  intermediate: { label: "Intermediate", className: "bg-yellow-100 text-yellow-800 border-yellow-200" },
  advanced: { label: "Advanced", className: "bg-red-100 text-red-800 border-red-200" },
} as const

interface PricingCardProps {
  course: Course
}

export function PricingCard({ course }: PricingCardProps) {
  const difficulty = difficultyConfig[course.difficulty]
  const isFree = !course.is_premium || course.price === 0

  return (
    <Card className="sticky top-4">
      <CardHeader>
        <CardTitle className="text-lg">Course Details</CardTitle>
        <div className="pt-2">
          {isFree ? (
            <span className="text-3xl font-bold text-green-600">Free</span>
          ) : (
            <span className="text-3xl font-bold">{formatPrice(course.price)}</span>
          )}
        </div>
      </CardHeader>

      <CardContent className="space-y-4">
        <ul className="space-y-3 text-sm">
          {course.modules_count !== undefined && (
            <li className="flex items-center gap-3">
              <Layers className="h-4 w-4 text-muted-foreground" />
              <span>{course.modules_count} modules</span>
            </li>
          )}
          {course.lessons_count !== undefined && (
            <li className="flex items-center gap-3">
              <BookOpen className="h-4 w-4 text-muted-foreground" />
              <span>{course.lessons_count} lessons</span>
            </li>
          )}
          <li className="flex items-center gap-3">
            <BarChart className="h-4 w-4 text-muted-foreground" />
            <Badge variant="outline" className={difficulty.className}>
              {difficulty.label}
            </Badge>
          </li>
        </ul>
      </CardContent>

      <CardFooter>
        {isFree ? (
          <Button asChild className="w-full" size="lg">
            <Link to={`/courses/${course.slug}`}>Start Learning</Link>
          </Button>
        ) : (
          <Button asChild className="w-full" size="lg">
            <Link to={`/courses/${course.slug}`}>
              Buy Now - {formatPrice(course.price)}
            </Link>
          </Button>
        )}
      </CardFooter>
    </Card>
  )
}
