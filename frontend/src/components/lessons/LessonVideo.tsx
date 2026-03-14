import { Play } from "lucide-react"

interface LessonVideoProps {
  videoUrl: string | null
}

function isEmbeddableUrl(url: string): boolean {
  return (
    url.includes("youtube.com") ||
    url.includes("youtu.be") ||
    url.includes("vimeo.com")
  )
}

function getEmbedUrl(url: string): string {
  // YouTube: convert watch URL to embed URL
  const youtubeMatch = url.match(
    /(?:youtube\.com\/watch\?v=|youtu\.be\/)([\w-]+)/
  )
  if (youtubeMatch) {
    return `https://www.youtube.com/embed/${youtubeMatch[1]}`
  }

  // Vimeo: convert to embed URL
  const vimeoMatch = url.match(/vimeo\.com\/(\d+)/)
  if (vimeoMatch) {
    return `https://player.vimeo.com/video/${vimeoMatch[1]}`
  }

  return url
}

export function LessonVideo({ videoUrl }: LessonVideoProps) {
  if (!videoUrl) return null

  if (isEmbeddableUrl(videoUrl)) {
    return (
      <div className="relative w-full overflow-hidden rounded-lg bg-black aspect-video">
        <iframe
          src={getEmbedUrl(videoUrl)}
          className="absolute inset-0 h-full w-full"
          allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
          allowFullScreen
          title="Lesson video"
        />
      </div>
    )
  }

  // Direct video URL - show placeholder with play icon
  return (
    <div className="relative w-full overflow-hidden rounded-lg bg-black aspect-video">
      <video
        src={videoUrl}
        className="absolute inset-0 h-full w-full"
        controls
        preload="metadata"
      />
      <div className="absolute inset-0 flex items-center justify-center bg-black/30 pointer-events-none">
        <div className="flex h-16 w-16 items-center justify-center rounded-full bg-white/90 shadow-lg">
          <Play className="h-8 w-8 text-primary ml-1" />
        </div>
      </div>
    </div>
  )
}
