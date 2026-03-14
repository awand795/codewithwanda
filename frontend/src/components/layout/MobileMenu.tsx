import { Link } from "react-router-dom"
import {
  Sheet,
  SheetContent,
  SheetHeader,
  SheetTitle,
} from "@/components/ui/sheet"
import { Button } from "@/components/ui/button"
import { useAuthStore } from "@/stores/authStore"
import { useLogout } from "@/hooks/useAuth"
import { LogOut, LayoutDashboard, CreditCard } from "lucide-react"

interface MobileMenuProps {
  open: boolean
  onOpenChange: (open: boolean) => void
}

export default function MobileMenu({ open, onOpenChange }: MobileMenuProps) {
  const { isAuthenticated, user } = useAuthStore()
  const logout = useLogout()

  const closeMenu = () => onOpenChange(false)

  const handleLogout = () => {
    closeMenu()
    logout.mutate()
  }

  return (
    <Sheet open={open} onOpenChange={onOpenChange}>
      <SheetContent side="left" className="w-72">
        <SheetHeader>
          <SheetTitle>
            <Link to="/" onClick={closeMenu} className="text-xl font-bold text-primary">
              LearnPath
            </Link>
          </SheetTitle>
        </SheetHeader>

        <nav className="mt-6 flex flex-col gap-1">
          <Link
            to="/categories"
            onClick={closeMenu}
            className="rounded-md px-3 py-2 text-sm font-medium text-foreground hover:bg-accent hover:text-accent-foreground transition-colors"
          >
            Categories
          </Link>
          <Link
            to="/courses"
            onClick={closeMenu}
            className="rounded-md px-3 py-2 text-sm font-medium text-foreground hover:bg-accent hover:text-accent-foreground transition-colors"
          >
            Courses
          </Link>
        </nav>

        <div className="mt-6 border-t pt-6">
          {isAuthenticated ? (
            <div className="flex flex-col gap-1">
              {user && (
                <p className="mb-2 px-3 text-sm font-medium text-muted-foreground truncate">
                  {user.name}
                </p>
              )}
              <Link
                to="/dashboard"
                onClick={closeMenu}
                className="flex items-center gap-2 rounded-md px-3 py-2 text-sm font-medium text-foreground hover:bg-accent hover:text-accent-foreground transition-colors"
              >
                <LayoutDashboard className="h-4 w-4" />
                Dashboard
              </Link>
              <Link
                to="/payments"
                onClick={closeMenu}
                className="flex items-center gap-2 rounded-md px-3 py-2 text-sm font-medium text-foreground hover:bg-accent hover:text-accent-foreground transition-colors"
              >
                <CreditCard className="h-4 w-4" />
                Payment History
              </Link>
              <button
                onClick={handleLogout}
                className="flex items-center gap-2 rounded-md px-3 py-2 text-sm font-medium text-destructive hover:bg-destructive/10 transition-colors text-left"
              >
                <LogOut className="h-4 w-4" />
                Logout
              </button>
            </div>
          ) : (
            <div className="flex flex-col gap-2 px-3">
              <Button asChild variant="outline" className="w-full">
                <Link to="/login" onClick={closeMenu}>
                  Login
                </Link>
              </Button>
              <Button asChild className="w-full">
                <Link to="/register" onClick={closeMenu}>
                  Register
                </Link>
              </Button>
            </div>
          )}
        </div>
      </SheetContent>
    </Sheet>
  )
}
