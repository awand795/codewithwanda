import { useState, useCallback } from "react"
import { useNavigate } from "react-router-dom"
import { Plus, Pencil, Trash2, Eye, EyeOff, Search, Filter, ChevronLeft, ChevronRight } from "lucide-react"
import { useAdminCourses, useDeleteCourse, useBulkPublish, useBulkUnpublish } from "@/hooks/admin/useAdminCourses"
import { useAdminCategories } from "@/hooks/admin/useAdminCategories"
import { Button } from "@/components/ui/button"
import { Input } from "@/components/ui/input"
import { Badge } from "@/components/ui/badge"
import { Card, CardContent } from "@/components/ui/card"
import { useToast } from "@/hooks/use-toast"
import type { Category, Course } from "@/types"

function formatPrice(price: number): string {
  return new Intl.NumberFormat('id-ID', {
    style: 'currency',
    currency: 'IDR',
    minimumFractionDigits: 0,
  }).format(price)
}

export default function AdminCoursesPage() {
  const navigate = useNavigate()
  const { toast } = useToast()
  const [page, setPage] = useState(1)
  const [search, setSearch] = useState("")
  const [categoryId, setCategoryId] = useState<number | undefined>()
  const [isPublished, setIsPublished] = useState<boolean | undefined>()
  const [selectedCourses, setSelectedCourses] = useState<number[]>([])

  const { data, isLoading } = useAdminCourses({
    page,
    category_id: categoryId,
    is_published: isPublished,
    search: search || undefined,
    per_page: 10,
  })

  const { data: categories } = useAdminCategories()
  const deleteCourse = useDeleteCourse()
  const bulkPublish = useBulkPublish()
  const bulkUnpublish = useBulkUnpublish()

  const courses = data?.data || []
  const meta = data?.meta

  const handleDelete = useCallback((id: number, title: string) => {
    if (window.confirm(`Are you sure you want to delete "${title}"?`)) {
      deleteCourse.mutate(id, {
        onSuccess: () => {
          toast({
            title: "Course deleted",
            description: "The course has been deleted successfully.",
          })
        },
        onError: () => {
          toast({
            title: "Delete failed",
            description: "Failed to delete the course.",
            variant: "destructive",
          })
        },
      })
    }
  }, [deleteCourse, toast])

  const handleBulkPublish = () => {
    if (selectedCourses.length === 0) return
    bulkPublish.mutate(selectedCourses, {
      onSuccess: () => {
        toast({
          title: "Courses published",
          description: `${selectedCourses.length} courses have been published.`,
        })
        setSelectedCourses([])
      },
    })
  }

  const handleBulkUnpublish = () => {
    if (selectedCourses.length === 0) return
    bulkUnpublish.mutate(selectedCourses, {
      onSuccess: () => {
        toast({
          title: "Courses unpublished",
          description: `${selectedCourses.length} courses have been unpublished.`,
        })
        setSelectedCourses([])
      },
    })
  }

  const toggleCourseSelection = (id: number) => {
    setSelectedCourses(prev =>
      prev.includes(id) ? prev.filter(c => c !== id) : [...prev, id]
    )
  }

  const toggleAllCourses = () => {
    if (selectedCourses.length === courses.length) {
      setSelectedCourses([])
    } else {
      setSelectedCourses(courses.map((c: Course) => c.id))
    }
  }

  return (
    <div className="space-y-6">
      {/* Header Actions */}
      <div className="flex flex-col sm:flex-row gap-4 justify-between">
        <div className="flex flex-wrap gap-2 items-center">
          <div className="relative">
            <Search className="absolute left-3 top-1/2 -translate-y-1/2 h-4 w-4 text-muted-foreground" />
            <Input
              placeholder="Search courses..."
              value={search}
              onChange={(e) => setSearch(e.target.value)}
              className="pl-10 w-64"
            />
          </div>
          
          <div className="flex items-center gap-2">
            <Filter className="h-4 w-4 text-muted-foreground" />
            <select
              value={categoryId || ""}
              onChange={(e) => setCategoryId(e.target.value ? Number(e.target.value) : undefined)}
              className="h-9 rounded-md border border-input bg-transparent px-3 py-1 text-sm shadow-sm"
            >
              <option value="">All Categories</option>
              {categories?.map((cat: Category) => (
                <option key={cat.id} value={cat.id}>{cat.name}</option>
              ))}
            </select>

            <select
              value={isPublished === undefined ? "" : isPublished ? "published" : "unpublished"}
              onChange={(e) => {
                const val = e.target.value
                setIsPublished(val === "" ? undefined : val === "published")
              }}
              className="h-9 rounded-md border border-input bg-transparent px-3 py-1 text-sm shadow-sm"
            >
              <option value="">All Status</option>
              <option value="published">Published</option>
              <option value="unpublished">Unpublished</option>
            </select>
          </div>
        </div>

        <div className="flex gap-2">
          {selectedCourses.length > 0 && (
            <>
              <Button variant="outline" size="sm" onClick={handleBulkPublish}>
                <Eye className="h-4 w-4 mr-2" />
                Publish ({selectedCourses.length})
              </Button>
              <Button variant="outline" size="sm" onClick={handleBulkUnpublish}>
                <EyeOff className="h-4 w-4 mr-2" />
                Unpublish ({selectedCourses.length})
              </Button>
            </>
          )}
          <Button onClick={() => navigate("/admin/courses/new")}>
            <Plus className="h-4 w-4 mr-2" />
            Add Course
          </Button>
        </div>
      </div>

      {/* Courses Table */}
      <Card>
        <CardContent className="p-0">
          {isLoading ? (
            <div className="p-6 space-y-4">
              {Array.from({ length: 5 }).map((_, i) => (
                <div key={i} className="h-16 bg-muted rounded animate-pulse" />
              ))}
            </div>
          ) : courses.length === 0 ? (
            <div className="text-center py-16">
              <p className="text-muted-foreground">No courses found.</p>
            </div>
          ) : (
            <div className="overflow-x-auto">
              <table className="w-full">
                <thead className="bg-muted/50">
                  <tr>
                    <th className="p-4 text-left">
                      <input
                        type="checkbox"
                        checked={selectedCourses.length === courses.length && courses.length > 0}
                        onChange={toggleAllCourses}
                        className="rounded border-gray-300"
                      />
                    </th>
                    <th className="p-4 text-left font-medium">Thumbnail</th>
                    <th className="p-4 text-left font-medium">Title</th>
                    <th className="p-4 text-left font-medium">Category</th>
                    <th className="p-4 text-left font-medium">Price</th>
                    <th className="p-4 text-left font-medium">Difficulty</th>
                    <th className="p-4 text-left font-medium">Status</th>
                    <th className="p-4 text-left font-medium">Actions</th>
                  </tr>
                </thead>
                <tbody>
                  {courses.map((course: Course) => (
                    <tr key={course.id} className="border-t hover:bg-muted/50">
                      <td className="p-4">
                        <input
                          type="checkbox"
                          checked={selectedCourses.includes(course.id)}
                          onChange={() => toggleCourseSelection(course.id)}
                          className="rounded border-gray-300"
                        />
                      </td>
                      <td className="p-4">
                        {course.thumbnail ? (
                          <img
                            src={course.thumbnail}
                            alt={course.title}
                            className="h-12 w-20 object-cover rounded"
                          />
                        ) : (
                          <div className="h-12 w-20 bg-muted rounded flex items-center justify-center">
                            <span className="text-xs text-muted-foreground">No Image</span>
                          </div>
                        )}
                      </td>
                      <td className="p-4">
                        <div>
                          <p className="font-medium">{course.title}</p>
                          <p className="text-xs text-muted-foreground">{course.slug}</p>
                        </div>
                      </td>
                      <td className="p-4">
                        <Badge variant="secondary">{course.category?.name || "N/A"}</Badge>
                      </td>
                      <td className="p-4 font-medium">{formatPrice(course.price)}</td>
                      <td className="p-4">
                        <Badge
                          variant={
                            course.difficulty === "beginner"
                              ? "default"
                              : course.difficulty === "intermediate"
                              ? "secondary"
                              : "destructive"
                          }
                        >
                          {course.difficulty}
                        </Badge>
                      </td>
                      <td className="p-4">
                        <Badge variant={course.is_published ? "default" : "outline"}>
                          {course.is_published ? "Published" : "Unpublished"}
                        </Badge>
                      </td>
                      <td className="p-4">
                        <div className="flex gap-2">
                          <Button
                            variant="ghost"
                            size="sm"
                            onClick={() => navigate(`/admin/courses/${course.id}/edit`)}
                          >
                            <Pencil className="h-4 w-4" />
                          </Button>
                          <Button
                            variant="ghost"
                            size="sm"
                            onClick={() => handleDelete(course.id, course.title)}
                          >
                            <Trash2 className="h-4 w-4 text-destructive" />
                          </Button>
                        </div>
                      </td>
                    </tr>
                  ))}
                </tbody>
              </table>
            </div>
          )}
        </CardContent>
      </Card>

      {/* Pagination */}
      {meta && meta.last_page > 1 && (
        <div className="flex items-center justify-center gap-2">
          <Button
            variant="outline"
            size="sm"
            onClick={() => setPage(page - 1)}
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
            onClick={() => setPage(page + 1)}
            disabled={page >= meta.last_page}
          >
            Next
            <ChevronRight className="h-4 w-4" />
          </Button>
        </div>
      )}
    </div>
  )
}
