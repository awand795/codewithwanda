import { useState, useEffect, useCallback } from "react"
import { Search, X } from "lucide-react"
import { Input } from "@/components/ui/input"
import { Button } from "@/components/ui/button"
import type { Category } from "@/types"

export interface CourseFilterValues {
  search: string
  category_id: number | null
  difficulty: string | null
  is_free: boolean | null
}

interface CourseFiltersProps {
  categories: Category[]
  onFilterChange: (filters: CourseFilterValues) => void
}

export function CourseFilters({ categories, onFilterChange }: CourseFiltersProps) {
  const [filters, setFilters] = useState<CourseFilterValues>({
    search: "",
    category_id: null,
    difficulty: null,
    is_free: null,
  })

  const [searchInput, setSearchInput] = useState("")

  // Debounced search
  useEffect(() => {
    const timer = setTimeout(() => {
      setFilters((prev) => ({ ...prev, search: searchInput }))
    }, 300)
    return () => clearTimeout(timer)
  }, [searchInput])

  // Notify parent on filter change
  useEffect(() => {
    onFilterChange(filters)
  }, [filters, onFilterChange])

  const handleCategoryChange = useCallback(
    (e: React.ChangeEvent<HTMLSelectElement>) => {
      const value = e.target.value
      setFilters((prev) => ({
        ...prev,
        category_id: value ? Number(value) : null,
      }))
    },
    []
  )

  const handleDifficultyChange = useCallback(
    (e: React.ChangeEvent<HTMLSelectElement>) => {
      const value = e.target.value
      setFilters((prev) => ({
        ...prev,
        difficulty: value || null,
      }))
    },
    []
  )

  const handlePricingToggle = useCallback((value: boolean | null) => {
    setFilters((prev) => ({
      ...prev,
      is_free: prev.is_free === value ? null : value,
    }))
  }, [])

  const handleReset = useCallback(() => {
    setSearchInput("")
    setFilters({
      search: "",
      category_id: null,
      difficulty: null,
      is_free: null,
    })
  }, [])

  const hasActiveFilters =
    filters.search ||
    filters.category_id !== null ||
    filters.difficulty !== null ||
    filters.is_free !== null

  return (
    <div className="flex flex-col gap-3 sm:flex-row sm:items-center sm:flex-wrap">
      {/* Search input */}
      <div className="relative flex-1 min-w-[200px]">
        <Search className="absolute left-3 top-1/2 h-4 w-4 -translate-y-1/2 text-muted-foreground" />
        <Input
          placeholder="Search courses..."
          value={searchInput}
          onChange={(e) => setSearchInput(e.target.value)}
          className="pl-9"
        />
      </div>

      {/* Category filter */}
      <select
        value={filters.category_id ?? ""}
        onChange={handleCategoryChange}
        className="flex h-9 rounded-md border border-input bg-transparent px-3 py-1 text-sm shadow-sm transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring"
      >
        <option value="">All Categories</option>
        {categories.map((cat) => (
          <option key={cat.id} value={cat.id}>
            {cat.name}
          </option>
        ))}
      </select>

      {/* Difficulty filter */}
      <select
        value={filters.difficulty ?? ""}
        onChange={handleDifficultyChange}
        className="flex h-9 rounded-md border border-input bg-transparent px-3 py-1 text-sm shadow-sm transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring"
      >
        <option value="">All Levels</option>
        <option value="beginner">Beginner</option>
        <option value="intermediate">Intermediate</option>
        <option value="advanced">Advanced</option>
      </select>

      {/* Free/Premium toggle */}
      <div className="flex items-center gap-1">
        <Button
          variant={filters.is_free === true ? "default" : "outline"}
          size="sm"
          onClick={() => handlePricingToggle(true)}
        >
          Free
        </Button>
        <Button
          variant={filters.is_free === false ? "default" : "outline"}
          size="sm"
          onClick={() => handlePricingToggle(false)}
        >
          Premium
        </Button>
      </div>

      {/* Reset filters */}
      {hasActiveFilters && (
        <Button variant="ghost" size="sm" onClick={handleReset}>
          <X className="h-4 w-4 mr-1" />
          Clear
        </Button>
      )}
    </div>
  )
}
