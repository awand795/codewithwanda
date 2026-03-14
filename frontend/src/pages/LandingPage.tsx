import { useLanding } from "@/hooks/useLanding"
import { HeroSection } from "@/components/landing/HeroSection"
import { FeatureCards } from "@/components/landing/FeatureCards"
import { LearningPathPreview } from "@/components/landing/LearningPathPreview"
import { StatsSection } from "@/components/landing/StatsSection"
import { CTASection } from "@/components/landing/CTASection"
import { Skeleton } from "@/components/ui/skeleton"

function LandingPageSkeleton() {
  return (
    <div className="space-y-16">
      {/* Hero skeleton */}
      <div className="py-24 sm:py-32">
        <div className="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
          <div className="mx-auto max-w-3xl space-y-6 text-center">
            <Skeleton className="mx-auto h-6 w-64" />
            <Skeleton className="mx-auto h-12 w-full max-w-2xl" />
            <Skeleton className="mx-auto h-12 w-3/4" />
            <Skeleton className="mx-auto h-6 w-full max-w-xl" />
            <div className="flex justify-center gap-4 pt-4">
              <Skeleton className="h-10 w-36" />
              <Skeleton className="h-10 w-36" />
            </div>
          </div>
        </div>
      </div>

      {/* Feature cards skeleton */}
      <div className="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div className="grid gap-6 sm:grid-cols-2 lg:grid-cols-4">
          {Array.from({ length: 4 }).map((_, i) => (
            <div key={i} className="space-y-3 rounded-xl border p-6">
              <Skeleton className="h-12 w-12 rounded-lg" />
              <Skeleton className="h-5 w-32" />
              <Skeleton className="h-4 w-full" />
              <Skeleton className="h-4 w-3/4" />
            </div>
          ))}
        </div>
      </div>

      {/* Courses skeleton */}
      <div className="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div className="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
          {Array.from({ length: 6 }).map((_, i) => (
            <div key={i} className="space-y-3 rounded-xl border overflow-hidden">
              <Skeleton className="aspect-video w-full" />
              <div className="space-y-2 p-4">
                <Skeleton className="h-4 w-20" />
                <Skeleton className="h-5 w-full" />
                <Skeleton className="h-4 w-3/4" />
              </div>
            </div>
          ))}
        </div>
      </div>

      {/* Stats skeleton */}
      <div className="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div className="grid grid-cols-2 gap-6 lg:grid-cols-4">
          {Array.from({ length: 4 }).map((_, i) => (
            <div key={i} className="flex flex-col items-center space-y-3 rounded-xl border p-6">
              <Skeleton className="h-12 w-12 rounded-full" />
              <Skeleton className="h-8 w-20" />
              <Skeleton className="h-4 w-16" />
            </div>
          ))}
        </div>
      </div>
    </div>
  )
}

export default function LandingPage() {
  const { data, isLoading } = useLanding()

  if (isLoading) {
    return <LandingPageSkeleton />
  }

  return (
    <div>
      <HeroSection />
      <FeatureCards />
      {data?.featured_courses && (
        <LearningPathPreview courses={data.featured_courses} />
      )}
      {data?.stats && <StatsSection stats={data.stats} />}
      <CTASection />
    </div>
  )
}
