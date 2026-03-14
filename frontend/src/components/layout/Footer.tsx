import { Link } from "react-router-dom"

export default function Footer() {
  return (
    <footer className="border-t bg-muted/40">
      <div className="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8">
        <div className="flex flex-col items-center gap-4 sm:flex-row sm:justify-between">
          {/* Brand & copyright */}
          <div className="text-center sm:text-left">
            <Link to="/" className="text-lg font-bold text-primary">
              LearnPath
            </Link>
            <p className="mt-1 text-sm text-muted-foreground">
              &copy; {new Date().getFullYear()} LearnPath. All rights reserved.
            </p>
          </div>

          {/* Navigation links */}
          <nav className="flex items-center gap-6">
            <Link
              to="/categories"
              className="text-sm text-muted-foreground hover:text-foreground transition-colors"
            >
              Categories
            </Link>
            <Link
              to="/courses"
              className="text-sm text-muted-foreground hover:text-foreground transition-colors"
            >
              Courses
            </Link>
            <Link
              to="/about"
              className="text-sm text-muted-foreground hover:text-foreground transition-colors"
            >
              About
            </Link>
          </nav>
        </div>

        {/* Tagline */}
        <div className="mt-6 border-t pt-4 text-center">
          <p className="text-xs text-muted-foreground">
            Built with React &amp; Laravel
          </p>
        </div>
      </div>
    </footer>
  )
}
