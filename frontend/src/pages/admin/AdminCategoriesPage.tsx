import { useState, useCallback } from "react"
import { Plus, Pencil, Trash2 } from "lucide-react"
import { useAdminCategories, useCreateCategory, useUpdateCategory, useDeleteCategory } from "@/hooks/admin/useAdminCategories"
import { Button } from "@/components/ui/button"
import { Input } from "@/components/ui/input"
import { Label } from "@/components/ui/label"
import { Card, CardContent, CardHeader, CardTitle } from "@/components/ui/card"
import { Badge } from "@/components/ui/badge"
import {
  Dialog,
  DialogContent,
  DialogHeader,
  DialogTitle,
} from "@/components/ui/dialog"
import { useToast } from "@/hooks/use-toast"
import type { Category } from "@/types"

export default function AdminCategoriesPage() {
  const { toast } = useToast()
  const { data: categories, isLoading } = useAdminCategories()
  const createCategory = useCreateCategory()
  const updateCategory = useUpdateCategory()
  const deleteCategory = useDeleteCategory()

  const [isDialogOpen, setIsDialogOpen] = useState(false)
  const [editingCategory, setEditingCategory] = useState<Category | null>(null)
  const [formData, setFormData] = useState<Partial<Category>>({
    name: "",
    description: "",
    icon: "",
    order: 0,
  })

  const openCreateDialog = () => {
    setEditingCategory(null)
    setFormData({ name: "", description: "", icon: "", order: 0 })
    setIsDialogOpen(true)
  }

  const openEditDialog = (category: Category) => {
    setEditingCategory(category)
    setFormData({
      name: category.name,
      description: category.description || "",
      icon: category.icon || "",
      order: category.order,
    })
    setIsDialogOpen(true)
  }

  const handleSubmit = (e: React.FormEvent) => {
    e.preventDefault()

    if (!formData.name) {
      toast({
        title: "Validation error",
        description: "Please fill in the category name.",
        variant: "destructive",
      })
      return
    }

    const mutation = editingCategory
      ? updateCategory.mutateAsync({ id: editingCategory.id, data: formData })
      : createCategory.mutateAsync(formData)

    mutation
      .then(() => {
        toast({
          title: editingCategory ? "Category updated" : "Category created",
          description: `The category has been ${editingCategory ? "updated" : "created"} successfully.`,
        })
        setIsDialogOpen(false)
      })
      .catch(() => {
        toast({
          title: "Operation failed",
          description: `Failed to ${editingCategory ? "update" : "create"} the category.`,
          variant: "destructive",
        })
      })
  }

  const handleDelete = useCallback((id: number, name: string) => {
    if (window.confirm(`Are you sure you want to delete "${name}"?`)) {
      deleteCategory.mutate(id, {
        onSuccess: () => {
          toast({
            title: "Category deleted",
            description: "The category has been deleted successfully.",
          })
        },
        onError: (error: any) => {
          toast({
            title: "Delete failed",
            description: error.response?.data?.message || "Failed to delete the category.",
            variant: "destructive",
          })
        },
      })
    }
  }, [deleteCategory, toast])

  return (
    <div className="space-y-6">
      {/* Header */}
      <div className="flex justify-between items-center">
        <div>
          <h1 className="text-2xl font-bold">Categories Management</h1>
          <p className="text-muted-foreground">Manage course categories</p>
        </div>
        <Button onClick={openCreateDialog}>
          <Plus className="h-4 w-4 mr-2" />
          Add Category
        </Button>
      </div>

      {/* Dialog */}
      <Dialog open={isDialogOpen} onOpenChange={setIsDialogOpen}>
        <DialogContent>
          <DialogHeader>
            <DialogTitle>
              {editingCategory ? "Edit Category" : "Create New Category"}
            </DialogTitle>
          </DialogHeader>
          <form onSubmit={handleSubmit} className="space-y-4">
            <div className="space-y-2">
              <Label htmlFor="name">Name *</Label>
              <Input
                id="name"
                value={formData.name || ""}
                onChange={(e) => setFormData({ ...formData, name: e.target.value })}
                placeholder="Enter category name"
                required
              />
            </div>

            <div className="space-y-2">
              <Label htmlFor="description">Description</Label>
              <textarea
                id="description"
                value={formData.description || ""}
                onChange={(e) => setFormData({ ...formData, description: e.target.value })}
                placeholder="Enter category description"
                rows={3}
                className="flex w-full rounded-md border border-input bg-transparent px-3 py-2 text-sm shadow-sm"
              />
            </div>

            <div className="space-y-2">
              <Label htmlFor="icon">Icon (Lucide icon name)</Label>
              <Input
                id="icon"
                value={formData.icon || ""}
                onChange={(e) => setFormData({ ...formData, icon: e.target.value })}
                placeholder="e.g., Code, Book, Folder"
              />
            </div>

            <div className="space-y-2">
              <Label htmlFor="order">Display Order</Label>
              <Input
                id="order"
                type="number"
                value={formData.order || 0}
                onChange={(e) => setFormData({ ...formData, order: Number(e.target.value) })}
                placeholder="0"
              />
            </div>

            <div className="flex gap-2 justify-end pt-4">
              <Button type="button" variant="outline" onClick={() => setIsDialogOpen(false)}>
                Cancel
              </Button>
              <Button type="submit">
                {editingCategory ? "Update" : "Create"}
              </Button>
            </div>
          </form>
        </DialogContent>
      </Dialog>

      {/* Categories Grid */}
      <div className="grid gap-4 md:grid-cols-2 lg:grid-cols-3">
        {isLoading ? (
          Array.from({ length: 6 }).map((_, i) => (
            <Card key={i}>
              <CardHeader>
                <div className="h-6 w-32 bg-muted rounded animate-pulse" />
              </CardHeader>
              <CardContent>
                <div className="h-4 w-full bg-muted rounded animate-pulse mb-2" />
                <div className="h-4 w-2/3 bg-muted rounded animate-pulse" />
              </CardContent>
            </Card>
          ))
        ) : categories?.length === 0 ? (
          <div className="col-span-full text-center py-16">
            <p className="text-muted-foreground">No categories found. Create one to get started.</p>
          </div>
        ) : (
          categories?.map((category: Category) => (
            <Card key={category.id} className="group relative">
              <CardHeader>
                <div className="flex items-start justify-between">
                  <div className="flex items-center gap-3">
                    {category.icon && (
                      <div className="h-10 w-10 rounded-lg bg-primary/10 flex items-center justify-center">
                        <span className="text-primary font-semibold">
                          {category.icon.charAt(0)}
                        </span>
                      </div>
                    )}
                    <div>
                      <CardTitle className="text-lg">{category.name}</CardTitle>
                      <Badge variant="secondary" className="mt-1">
                        {category.courses_count || 0} courses
                      </Badge>
                    </div>
                  </div>
                  <div className="flex gap-1 opacity-0 group-hover:opacity-100 transition-opacity">
                    <Button
                      variant="ghost"
                      size="sm"
                      onClick={() => openEditDialog(category)}
                    >
                      <Pencil className="h-4 w-4" />
                    </Button>
                    <Button
                      variant="ghost"
                      size="sm"
                      onClick={() => handleDelete(category.id, category.name)}
                    >
                      <Trash2 className="h-4 w-4 text-destructive" />
                    </Button>
                  </div>
                </div>
              </CardHeader>
              {category.description && (
                <CardContent>
                  <p className="text-sm text-muted-foreground">{category.description}</p>
                </CardContent>
              )}
            </Card>
          ))
        )}
      </div>
    </div>
  )
}
