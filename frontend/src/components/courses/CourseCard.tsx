import { Link } from "react-router-dom"
import { BookOpen, Clock, BarChart, Star, Zap } from "lucide-react"
import { Card, CardContent, CardFooter, CardHeader } from "@/components/ui/card"
import { Badge } from "@/components/ui/badge"
import { formatPrice } from "@/lib/utils"
import type { Course } from "@/types"

const difficultyConfig = {
  beginner: { label: "Beginner", className: "bg-gradient-to-r from-green-500 to-emerald-500 text-white border-0" },
  intermediate: { label: "Intermediate", className: "bg-gradient-to-r from-yellow-500 to-orange-500 text-white border-0" },
  advanced: { label: "Advanced", className: "bg-gradient-to-r from-red-500 to-pink-500 text-white border-0" },
} as const

interface CourseCardProps {
  course: Course
}

export function CourseCard({ course }: CourseCardProps) {
  const difficulty = difficultyConfig[course.difficulty]

  return (
    <Link to={`/courses/${course.slug}`} className="group block h-full">
      <Card className="h-full overflow-hidden transition-all duration-300 hover:shadow-xl hover:-translate-y-1 border-0 shadow-lg bg-white">
        {/* Thumbnail */}
        <div className="relative aspect-video overflow-hidden">
          {course.thumbnail ? (
            <img 
              src={course.thumbnail} 
              alt={course.title}
              className="w-full h-full object-cover transition-transform duration-300 group-hover:scale-110"
            />
          ) : (
            <div className="w-full h-full bg-gradient-to-br from-blue-600 via-purple-600 to-pink-600 flex items-center justify-center">
              <BookOpen className="h-16 w-16 text-white/50" />
            </div>
          )}
          
          {/* Overlay gradient */}
          <div className="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
          
          {/* Premium/Free badge */}
          <div className="absolute top-3 left-3">
            {course.is_premium ? (
              <Badge className="bg-gradient-to-r from-amber-500 to-orange-500 text-white border-0 shadow-lg">
                <Zap className="h-3 w-3 mr-1" />
                Premium
              </Badge>
            ) : (
              <Badge className="bg-gradient-to-r from-green-500 to-emerald-500 text-white border-0 shadow-lg">
                <Star className="h-3 w-3 mr-1" />
                Free
              </Badge>
            )}
          </div>

          {/* Price badge */}
          <div className="absolute top-3 right-3">
            {course.is_premium && (
              <Badge className="bg-white/95 text-gray-900 font-semibold shadow-lg">
                {formatPrice(course.price)}
              </Badge>
            )}
          </div>

          {/* Hover play button */}
          <div className="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300">
            <div className="h-14 w-14 rounded-full bg-white/90 flex items-center justify-center shadow-lg transform scale-75 group-hover:scale-100 transition-transform">
              <BookOpen className="h-6 w-6 text-primary" />
            </div>
          </div>
        </div>

        <CardHeader className="pb-2 pt-4">
          {/* Category badge */}
          {course.category && (
            <div className="mb-2">
              <Badge variant="secondary" className="text-xs font-medium bg-gray-100 text-gray-700">
                {course.category.name}
              </Badge>
            </div>
          )}
          
          <h3 className="font-bold text-lg leading-tight line-clamp-2 group-hover:text-primary transition-colors text-gray-900">
            {course.title}
          </h3>
        </CardHeader>

        <CardContent className="pb-3">
          {/* Difficulty badge */}
          <div className="mb-3">
            <Badge className={difficulty.className} variant="default">
              {difficulty.label}
            </Badge>
          </div>
          
          {course.description && (
            <p className="text-sm text-gray-600 line-clamp-2 leading-relaxed">
              {course.description}
            </p>
          )}
        </CardContent>

        <CardFooter className="pt-3 border-t bg-gray-50/50">
          <div className="flex items-center justify-between w-full text-sm">
            <div className="flex items-center gap-4">
              {course.modules_count !== undefined && (
                <div className="flex items-center gap-1.5 text-gray-600">
                  <BarChart className="h-4 w-4 text-primary" />
                  <span className="font-medium">{course.modules_count}</span>
                  <span className="text-gray-500">modules</span>
                </div>
              )}
              {course.lessons_count !== undefined && (
                <div className="flex items-center gap-1.5 text-gray-600">
                  <Clock className="h-4 w-4 text-primary" />
                  <span className="font-medium">{course.lessons_count}</span>
                  <span className="text-gray-500">lessons</span>
                </div>
              )}
            </div>
          </div>
        </CardFooter>
      </Card>
    </Link>
  )
}
