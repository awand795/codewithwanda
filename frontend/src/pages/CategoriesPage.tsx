import { Link } from "react-router-dom"
import { useCategories } from "@/hooks/useCategories"
import { Card, CardContent } from "@/components/ui/card"
import { Badge } from "@/components/ui/badge"
import { Skeleton } from "@/components/ui/skeleton"
import {
  BookOpen,
  Code,
  Database,
  Globe,
  Layout,
  Layers,
  Server,
  Smartphone,
  Terminal,
  Palette,
  Shield,
  Cpu,
  type LucideIcon,
} from "lucide-react"
import type { Category } from "@/types"

const iconMap: Record<string, LucideIcon> = {
  "book-open": BookOpen,
  code: Code,
  database: Database,
  globe: Globe,
  layout: Layout,
  layers: Layers,
  server: Server,
  smartphone: Smartphone,
  terminal: Terminal,
  palette: Palette,
  shield: Shield,
  cpu: Cpu,
}

function getCategoryIcon(iconName: string | null): LucideIcon {
  if (!iconName) return BookOpen
  return iconMap[iconName] ?? BookOpen
}

function CategoriesSkeleton() {
  return (
    <div className="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
      {Array.from({ length: 6 }).map((_, i) => (
        <div key={i} className="space-y-3 rounded-xl border p-6">
          <Skeleton className="h-12 w-12 rounded-lg" />
          <Skeleton className="h-6 w-40" />
          <Skeleton className="h-4 w-full" />
          <Skeleton className="h-4 w-3/4" />
          <Skeleton className="h-5 w-24" />
        </div>
      ))}
    </div>
  )
}

function CategoryCard({ category }: { category: Category }) {
  const Icon = getCategoryIcon(category.icon)

  return (
    <Link to={`/courses?category=${category.slug}`} className="group block">
      <Card className="h-full transition-shadow hover:shadow-lg">
        <CardContent className="p-6">
          <div className="mb-4 inline-flex rounded-lg bg-primary/10 p-3 text-primary transition-colors group-hover:bg-primary/20">
            <Icon className="h-6 w-6" />
          </div>
          <h3 className="mb-2 text-lg font-semibold text-foreground group-hover:text-primary transition-colors">
            {category.name}
          </h3>
          {category.description && (
            <p className="mb-3 text-sm leading-relaxed text-muted-foreground line-clamp-2">
              {category.description}
            </p>
          )}
          {category.courses_count !== undefined && (
            <Badge variant="secondary">
              {category.courses_count} {category.courses_count === 1 ? "course" : "courses"}
            </Badge>
          )}
        </CardContent>
      </Card>
    </Link>
  )
}

export default function CategoriesPage() {
  const { data: categories, isLoading, error } = useCategories()

  return (
    <div className="mx-auto max-w-7xl px-4 py-12 sm:px-6 lg:px-8">
      <div className="mb-10">
        <h1 className="text-3xl font-bold tracking-tight text-foreground sm:text-4xl">
          Categories
        </h1>
        <p className="mt-3 text-lg text-muted-foreground">
          Browse courses by category to find the perfect learning path for you.
        </p>
      </div>

      {isLoading && <CategoriesSkeleton />}

      {error && (
        <div className="text-center py-16">
          <p className="text-destructive">
            Failed to load categories. Please try again later.
          </p>
        </div>
      )}

      {categories && categories.length === 0 && (
        <div className="text-center py-16">
          <Layers className="mx-auto h-16 w-16 text-muted-foreground/40 mb-4" />
          <h3 className="text-lg font-semibold text-muted-foreground">
            No categories available
          </h3>
          <p className="text-sm text-muted-foreground/70 mt-1">
            Check back later for new categories.
          </p>
        </div>
      )}

      {categories && categories.length > 0 && (
        <div className="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
          {categories.map((category) => (
            <CategoryCard key={category.id} category={category} />
          ))}
        </div>
      )}
    </div>
  )
}
