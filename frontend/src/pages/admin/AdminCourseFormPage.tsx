import { useState, useEffect } from "react"
import { useNavigate, useParams } from "react-router-dom"
import { ArrowLeft, Save } from "lucide-react"
import { useAdminCourse, useCreateCourse, useUpdateCourse } from "@/hooks/admin/useAdminCourses"
import { useAdminCategories } from "@/hooks/admin/useAdminCategories"
import { Button } from "@/components/ui/button"
import { Input } from "@/components/ui/input"
import { Label } from "@/components/ui/label"
import { Card, CardContent, CardHeader, CardTitle } from "@/components/ui/card"
import { useToast } from "@/hooks/use-toast"
import type { Course, Category } from "@/types"

export default function AdminCourseFormPage() {
  const { id } = useParams<{ id: string }>()
  const navigate = useNavigate()
  const { toast } = useToast()
  const isEdit = !!id

  const { data: course, isLoading: isLoadingCourse } = useAdminCourse(id ? Number(id) : null)
  const { data: categories } = useAdminCategories()
  const createCourse = useCreateCourse()
  const updateCourse = useUpdateCourse()

  const [formData, setFormData] = useState<Partial<Course>>({
    category_id: 0,
    title: "",
    description: "",
    thumbnail: "",
    price: 0,
    is_premium: false,
    difficulty: "beginner",
    is_published: false,
    order: 0,
  })

  useEffect(() => {
    if (course) {
      setFormData({
        category_id: course.category_id,
        title: course.title,
        description: course.description || "",
        thumbnail: course.thumbnail || "",
        price: course.price,
        is_premium: course.is_premium,
        difficulty: course.difficulty,
        is_published: course.is_published,
        order: course.order,
      })
    }
  }, [course])

  const handleSubmit = (e: React.FormEvent) => {
    e.preventDefault()

    if (!formData.category_id || !formData.title) {
      toast({
        title: "Validation error",
        description: "Please fill in all required fields.",
        variant: "destructive",
      })
      return
    }

    const mutation = isEdit
      ? updateCourse.mutateAsync({ id: Number(id), data: formData })
      : createCourse.mutateAsync(formData)

    mutation
      .then(() => {
        toast({
          title: isEdit ? "Course updated" : "Course created",
          description: `The course has been ${isEdit ? "updated" : "created"} successfully.`,
        })
        navigate("/admin/courses")
      })
      .catch(() => {
        toast({
          title: "Operation failed",
          description: `Failed to ${isEdit ? "update" : "create"} the course.`,
          variant: "destructive",
        })
      })
  }

  if (isLoadingCourse) {
    return (
      <div className="space-y-6">
        <Card>
          <CardHeader>
            <div className="h-8 w-48 bg-muted rounded animate-pulse" />
          </CardHeader>
          <CardContent className="space-y-4">
            {Array.from({ length: 6 }).map((_, i) => (
              <div key={i} className="h-12 bg-muted rounded animate-pulse" />
            ))}
          </CardContent>
        </Card>
      </div>
    )
  }

  return (
    <div className="space-y-6">
      {/* Header */}
      <div className="flex items-center gap-4">
        <Button variant="ghost" size="icon" onClick={() => navigate("/admin/courses")}>
          <ArrowLeft className="h-5 w-5" />
        </Button>
        <div>
          <h1 className="text-2xl font-bold">{isEdit ? "Edit Course" : "Create New Course"}</h1>
          <p className="text-muted-foreground">
            {isEdit ? "Update course information" : "Add a new course to your catalog"}
          </p>
        </div>
      </div>

      {/* Form */}
      <form onSubmit={handleSubmit}>
        <Card>
          <CardHeader>
            <CardTitle>Course Information</CardTitle>
          </CardHeader>
          <CardContent className="space-y-6">
            {/* Title */}
            <div className="space-y-2">
              <Label htmlFor="title">Title *</Label>
              <Input
                id="title"
                value={formData.title}
                onChange={(e) => setFormData({ ...formData, title: e.target.value })}
                placeholder="Enter course title"
                required
              />
            </div>

            {/* Category */}
            <div className="space-y-2">
              <Label htmlFor="category">Category *</Label>
              <select
                id="category"
                value={formData.category_id || ""}
                onChange={(e) => setFormData({ ...formData, category_id: Number(e.target.value) })}
                className="flex h-9 w-full rounded-md border border-input bg-transparent px-3 py-1 text-sm shadow-sm"
                required
              >
                <option value="">Select a category</option>
                {categories?.map((cat: Category) => (
                  <option key={cat.id} value={cat.id}>
                    {cat.name}
                  </option>
                ))}
              </select>
            </div>

            {/* Description */}
            <div className="space-y-2">
              <Label htmlFor="description">Description</Label>
              <textarea
                id="description"
                value={formData.description || ""}
                onChange={(e) => setFormData({ ...formData, description: e.target.value })}
                placeholder="Enter course description"
                rows={5}
                className="flex w-full rounded-md border border-input bg-transparent px-3 py-2 text-sm shadow-sm"
              />
            </div>

            {/* Thumbnail URL */}
            <div className="space-y-2">
              <Label htmlFor="thumbnail">Thumbnail URL</Label>
              <Input
                id="thumbnail"
                value={formData.thumbnail || ""}
                onChange={(e) => setFormData({ ...formData, thumbnail: e.target.value })}
                placeholder="https://example.com/image.jpg"
              />
              {formData.thumbnail && (
                <div className="mt-2">
                  <img
                    src={formData.thumbnail}
                    alt="Thumbnail preview"
                    className="h-32 w-full object-cover rounded-md"
                  />
                </div>
              )}
            </div>

            {/* Price and Difficulty Row */}
            <div className="grid grid-cols-1 md:grid-cols-2 gap-4">
              {/* Price */}
              <div className="space-y-2">
                <Label htmlFor="price">Price (IDR) *</Label>
                <Input
                  id="price"
                  type="number"
                  min="0"
                  step="0.01"
                  value={formData.price}
                  onChange={(e) => setFormData({ ...formData, price: Number(e.target.value) })}
                  placeholder="0"
                  required
                />
              </div>

              {/* Difficulty */}
              <div className="space-y-2">
                <Label htmlFor="difficulty">Difficulty *</Label>
                <select
                  id="difficulty"
                  value={formData.difficulty}
                  onChange={(e) => setFormData({ ...formData, difficulty: e.target.value as any })}
                  className="flex h-9 w-full rounded-md border border-input bg-transparent px-3 py-1 text-sm shadow-sm"
                  required
                >
                  <option value="beginner">Beginner</option>
                  <option value="intermediate">Intermediate</option>
                  <option value="advanced">Advanced</option>
                </select>
              </div>
            </div>

            {/* Order */}
            <div className="space-y-2">
              <Label htmlFor="order">Display Order</Label>
              <Input
                id="order"
                type="number"
                value={formData.order}
                onChange={(e) => setFormData({ ...formData, order: Number(e.target.value) })}
                placeholder="0"
              />
              <p className="text-xs text-muted-foreground">
                Lower numbers appear first in listings
              </p>
            </div>

            {/* Toggles */}
            <div className="grid grid-cols-1 md:grid-cols-2 gap-4">
              <div className="flex items-center space-x-2">
                <input
                  type="checkbox"
                  id="is_premium"
                  checked={formData.is_premium}
                  onChange={(e) => setFormData({ ...formData, is_premium: e.target.checked })}
                  className="rounded border-gray-300"
                />
                <Label htmlFor="is_premium" className="cursor-pointer">
                  Premium Course
                </Label>
              </div>

              <div className="flex items-center space-x-2">
                <input
                  type="checkbox"
                  id="is_published"
                  checked={formData.is_published}
                  onChange={(e) => setFormData({ ...formData, is_published: e.target.checked })}
                  className="rounded border-gray-300"
                />
                <Label htmlFor="is_published" className="cursor-pointer">
                  Published (visible to users)
                </Label>
              </div>
            </div>

            {/* Submit Button */}
            <div className="flex gap-4 pt-4">
              <Button type="submit" className="min-w-[120px]">
                <Save className="h-4 w-4 mr-2" />
                {isEdit ? "Update Course" : "Create Course"}
              </Button>
              <Button
                type="button"
                variant="outline"
                onClick={() => navigate("/admin/courses")}
              >
                Cancel
              </Button>
            </div>
          </CardContent>
        </Card>
      </form>
    </div>
  )
}
