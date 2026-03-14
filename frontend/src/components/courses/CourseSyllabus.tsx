import { useState } from "react"
import { Link } from "react-router-dom"
import {
  ChevronDown,
  ChevronUp,
  Play,
  Lock,
  Clock,
  Eye,
} from "lucide-react"
import type { Module } from "@/types"

interface CourseSyllabusProps {
  modules: Module[]
}

export function CourseSyllabus({ modules }: CourseSyllabusProps) {
  const [expandedModules, setExpandedModules] = useState<Set<number>>(() => {
    // Expand the first module by default
    return new Set(modules.length > 0 ? [modules[0].id] : [])
  })

  const toggleModule = (moduleId: number) => {
    setExpandedModules((prev) => {
      const next = new Set(prev)
      if (next.has(moduleId)) {
        next.delete(moduleId)
      } else {
        next.add(moduleId)
      }
      return next
    })
  }

  if (modules.length === 0) {
    return (
      <p className="text-sm text-muted-foreground py-4">
        No syllabus available yet.
      </p>
    )
  }

  return (
    <div className="space-y-2">
      {modules.map((module, index) => {
        const isExpanded = expandedModules.has(module.id)
        const lessonsCount = module.lessons?.length ?? module.lessons_count ?? 0

        return (
          <div
            key={module.id}
            className="rounded-lg border bg-card overflow-hidden"
          >
            {/* Module header */}
            <button
              onClick={() => toggleModule(module.id)}
              className="flex w-full items-center justify-between p-4 text-left hover:bg-muted/50 transition-colors"
            >
              <div className="flex items-center gap-3">
                <span className="flex h-8 w-8 shrink-0 items-center justify-center rounded-full bg-primary/10 text-sm font-semibold text-primary">
                  {index + 1}
                </span>
                <div>
                  <h4 className="font-medium leading-tight">{module.title}</h4>
                  <p className="text-xs text-muted-foreground mt-0.5">
                    {lessonsCount} {lessonsCount === 1 ? "lesson" : "lessons"}
                  </p>
                </div>
              </div>
              {isExpanded ? (
                <ChevronUp className="h-5 w-5 text-muted-foreground shrink-0" />
              ) : (
                <ChevronDown className="h-5 w-5 text-muted-foreground shrink-0" />
              )}
            </button>

            {/* Lessons list */}
            {isExpanded && module.lessons && module.lessons.length > 0 && (
              <div className="border-t">
                <ul className="divide-y">
                  {module.lessons.map((lesson) => (
                    <li key={lesson.id}>
                      <Link
                        to={`/lessons/${lesson.slug}`}
                        className="flex items-center gap-3 px-4 py-3 hover:bg-muted/30 transition-colors"
                      >
                        {/* Play / Lock icon */}
                        <span className="flex h-7 w-7 shrink-0 items-center justify-center rounded-full bg-muted">
                          {lesson.is_free_preview ? (
                            <Play className="h-3.5 w-3.5 text-primary" />
                          ) : (
                            <Lock className="h-3.5 w-3.5 text-muted-foreground" />
                          )}
                        </span>

                        {/* Lesson info */}
                        <div className="flex-1 min-w-0">
                          <p className="text-sm font-medium leading-tight truncate">
                            {lesson.title}
                          </p>
                        </div>

                        {/* Badges & duration */}
                        <div className="flex items-center gap-2 shrink-0">
                          {lesson.is_free_preview && (
                            <span className="inline-flex items-center gap-1 rounded-full bg-green-100 px-2 py-0.5 text-xs font-medium text-green-700">
                              <Eye className="h-3 w-3" />
                              Preview
                            </span>
                          )}
                          {lesson.duration_minutes > 0 && (
                            <span className="flex items-center gap-1 text-xs text-muted-foreground">
                              <Clock className="h-3 w-3" />
                              {lesson.duration_minutes}m
                            </span>
                          )}
                        </div>
                      </Link>
                    </li>
                  ))}
                </ul>
              </div>
            )}
          </div>
        )
      })}
    </div>
  )
}
