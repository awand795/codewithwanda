import { BookOpen, Trophy, Users, Zap } from "lucide-react"
import { Card, CardContent } from "@/components/ui/card"

const features = [
  {
    icon: BookOpen,
    title: "Structured Curriculum",
    description:
      "Follow carefully designed learning paths that take you from fundamentals to advanced topics in a logical progression.",
  },
  {
    icon: Zap,
    title: "Hands-On Projects",
    description:
      "Apply what you learn with practical exercises and real-world projects that build your portfolio and confidence.",
  },
  {
    icon: Trophy,
    title: "Track Your Progress",
    description:
      "Monitor your advancement through each course with detailed progress tracking and completion milestones.",
  },
  {
    icon: Users,
    title: "Community Driven",
    description:
      "Join a growing community of developers learning together. Share knowledge, ask questions, and grow as a team.",
  },
]

export function FeatureCards() {
  return (
    <section className="py-20 sm:py-24">
      <div className="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div className="mx-auto max-w-2xl text-center">
          <h2 className="text-3xl font-bold tracking-tight text-foreground sm:text-4xl">
            Why Learn With Us?
          </h2>
          <p className="mt-4 text-lg text-muted-foreground">
            Everything you need to go from beginner to professional developer,
            all in one platform.
          </p>
        </div>

        <div className="mt-16 grid gap-6 sm:grid-cols-2 lg:grid-cols-4">
          {features.map((feature) => (
            <Card
              key={feature.title}
              className="group relative overflow-hidden border-muted/50 transition-all hover:border-primary/30 hover:shadow-lg"
            >
              <CardContent className="p-6">
                <div className="mb-4 inline-flex rounded-lg bg-primary/10 p-3 text-primary transition-colors group-hover:bg-primary/20">
                  <feature.icon className="h-6 w-6" />
                </div>
                <h3 className="mb-2 text-lg font-semibold text-foreground">
                  {feature.title}
                </h3>
                <p className="text-sm leading-relaxed text-muted-foreground">
                  {feature.description}
                </p>
              </CardContent>
            </Card>
          ))}
        </div>
      </div>
    </section>
  )
}
