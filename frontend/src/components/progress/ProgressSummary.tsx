import { useCourseSummary } from "@/hooks/useProgress"
import { ProgressBar } from "@/components/progress/ProgressBar"
import { Skeleton } from "@/components/ui/skeleton"

interface ProgressSummaryProps {
  courseId: number
}

export function ProgressSummary({ courseId }: ProgressSummaryProps) {
  const { data, isLoading } = useCourseSummary(courseId)

  if (isLoading) {
    return (
      <div className="space-y-2">
        <Skeleton className="h-2 w-full" />
        <Skeleton className="h-4 w-48" />
      </div>
    )
  }

  if (!data) return null

  return (
    <ProgressBar
      percentage={data.percentage}
      completed={data.completed}
      total={data.total}
    />
  )
}
