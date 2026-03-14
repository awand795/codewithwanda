import { useCallback } from "react"
import { useSearchParams } from "react-router-dom"
import { useCourses } from "@/hooks/useCourses"
import { useCategories } from "@/hooks/useCategories"
import { CourseFilters, type CourseFilterValues } from "@/components/courses/CourseFilters"
import { CourseGrid } from "@/components/courses/CourseGrid"
import { Button } from "@/components/ui/button"
import { Skeleton } from "@/components/ui/skeleton"
import { ChevronLeft, ChevronRight } from "lucide-react"

function CoursesPageSkeleton() {
  return (
    <div className="space-y-8">
      {/* Filters skeleton */}
      <div className="flex flex-wrap gap-3">
        <Skeleton className="h-9 flex-1 min-w-[200px]" />
        <Skeleton className="h-9 w-40" />
        <Skeleton className="h-9 w-32" />
        <Skeleton className="h-9 w-32" />
      </div>

      {/* Grid skeleton */}
      <div className="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3">
        {Array.from({ length: 6 }).map((_, i) => (
          <div key={i} className="space-y-3 rounded-xl border overflow-hidden">
            <Skeleton className="aspect-video w-full" />
            <div className="space-y-2 p-4">
              <Skeleton className="h-4 w-20" />
              <Skeleton className="h-5 w-full" />
              <Skeleton className="h-4 w-3/4" />
            </div>
          </div>
        ))}
      </div>
    </div>
  )
}

export default function CoursesPage() {
  const [searchParams, setSearchParams] = useSearchParams()

  const page = Number(searchParams.get("page")) || 1
  const category = searchParams.get("category") ?? undefined
  const difficulty = searchParams.get("difficulty") ?? undefined
  const search = searchParams.get("search") ?? undefined
  const isPremium = searchParams.get("is_premium")
  const is_premium = isPremium === "true" ? true : isPremium === "false" ? false : undefined

  const { data, isLoading, error } = useCourses({
    page,
    category,
    difficulty,
    search,
    is_premium,
    per_page: 12,
  })

  const { data: categories } = useCategories()

  const handleFilterChange = useCallback(
    (filters: CourseFilterValues) => {
      const params = new URLSearchParams()

      if (filters.search) params.set("search", filters.search)
      if (filters.category_id) {
        const cat = categories?.find((c) => c.id === filters.category_id)
        if (cat) params.set("category", cat.slug)
      }
      if (filters.difficulty) params.set("difficulty", filters.difficulty)
      if (filters.is_free === true) params.set("is_premium", "false")
      else if (filters.is_free === false) params.set("is_premium", "true")

      // Reset to page 1 on filter change
      setSearchParams(params)
    },
    [categories, setSearchParams]
  )

  const handlePageChange = useCallback(
    (newPage: number) => {
      const params = new URLSearchParams(searchParams)
      if (newPage > 1) {
        params.set("page", String(newPage))
      } else {
        params.delete("page")
      }
      setSearchParams(params)
    },
    [searchParams, setSearchParams]
  )

  const courses = data?.data ?? []
  const meta = data?.meta

  return (
    <div className="mx-auto max-w-7xl px-4 py-12 sm:px-6 lg:px-8">
      <div className="mb-10">
        <h1 className="text-3xl font-bold tracking-tight text-foreground sm:text-4xl">
          Courses
        </h1>
        <p className="mt-3 text-lg text-muted-foreground">
          Explore our collection of courses and start learning today.
        </p>
      </div>

      {isLoading ? (
        <CoursesPageSkeleton />
      ) : (
        <div className="space-y-8">
          {/* Filters */}
          <CourseFilters
            categories={categories ?? []}
            onFilterChange={handleFilterChange}
          />

          {/* Error state */}
          {error && (
            <div className="text-center py-16">
              <p className="text-destructive">
                Failed to load courses. Please try again later.
              </p>
            </div>
          )}

          {/* Course grid */}
          {!error && <CourseGrid courses={courses} />}

          {/* Pagination */}
          {meta && meta.last_page > 1 && (
            <div className="flex items-center justify-center gap-2 pt-4">
              <Button
                variant="outline"
                size="sm"
                onClick={() => handlePageChange(page - 1)}
                disabled={page <= 1}
              >
                <ChevronLeft className="h-4 w-4" />
                Previous
              </Button>
              <span className="text-sm text-muted-foreground px-4">
                Page {meta.current_page} of {meta.last_page}
              </span>
              <Button
                variant="outline"
                size="sm"
                onClick={() => handlePageChange(page + 1)}
                disabled={page >= meta.last_page}
              >
                Next
                <ChevronRight className="h-4 w-4" />
              </Button>
            </div>
          )}
        </div>
      )}
    </div>
  )
}
