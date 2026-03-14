import { CheckCircle, Circle } from "lucide-react"

interface CompletionBadgeProps {
  isCompleted: boolean
}

export function CompletionBadge({ isCompleted }: CompletionBadgeProps) {
  if (isCompleted) {
    return <CheckCircle className="h-5 w-5 text-green-500 shrink-0" />
  }

  return <Circle className="h-5 w-5 text-muted-foreground/40 shrink-0" />
}
