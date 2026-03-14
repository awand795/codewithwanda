import { BookOpen, GraduationCap, Layers, Users } from "lucide-react"

interface StatsSectionProps {
  stats: {
    total_courses: number
    total_lessons: number
    total_students: number
    total_categories: number
  }
}

const statConfig = [
  {
    key: "total_courses" as const,
    label: "Courses",
    icon: BookOpen,
  },
  {
    key: "total_lessons" as const,
    label: "Lessons",
    icon: GraduationCap,
  },
  {
    key: "total_students" as const,
    label: "Students",
    icon: Users,
  },
  {
    key: "total_categories" as const,
    label: "Categories",
    icon: Layers,
  },
]

function formatNumber(num: number): string {
  if (num >= 1000) {
    return `${(num / 1000).toFixed(num >= 10000 ? 0 : 1)}k+`
  }
  return num.toLocaleString()
}

export function StatsSection({ stats }: StatsSectionProps) {
  return (
    <section className="py-16 sm:py-20">
      <div className="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div className="grid grid-cols-2 gap-6 lg:grid-cols-4">
          {statConfig.map(({ key, label, icon: Icon }) => (
            <div
              key={key}
              className="flex flex-col items-center rounded-xl border bg-card p-6 text-center shadow-sm transition-shadow hover:shadow-md sm:p-8"
            >
              <div className="mb-4 inline-flex rounded-full bg-primary/10 p-3">
                <Icon className="h-6 w-6 text-primary" />
              </div>
              <span className="text-3xl font-bold tracking-tight text-foreground sm:text-4xl">
                {formatNumber(stats[key])}
              </span>
              <span className="mt-1 text-sm font-medium text-muted-foreground">
                {label}
              </span>
            </div>
          ))}
        </div>
      </div>
    </section>
  )
}
