import { Progress } from "@/components/ui/progress"

interface ProgressBarProps {
  percentage: number
  completed: number
  total: number
}

export function ProgressBar({ percentage, completed, total }: ProgressBarProps) {
  return (
    <div className="space-y-2">
      <Progress value={percentage} />
      <p className="text-sm text-muted-foreground">
        {completed} of {total} lessons completed ({Math.round(percentage)}%)
      </p>
    </div>
  )
}
