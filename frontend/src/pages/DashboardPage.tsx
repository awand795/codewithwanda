import { Link } from "react-router-dom"
import { useAuthStore } from "@/stores/authStore"
import {
  Card,
  CardContent,
  CardDescription,
  CardHeader,
  CardTitle,
} from "@/components/ui/card"
import { Button } from "@/components/ui/button"
import { Badge } from "@/components/ui/badge"
import {
  BookOpen,
  CreditCard,
  GraduationCap,
  User,
} from "lucide-react"

export default function DashboardPage() {
  const { user } = useAuthStore()

  const roleConfig = {
    free: { label: "Free", className: "bg-gray-100 text-gray-800 border-gray-200" },
    premium: { label: "Premium", className: "bg-primary/10 text-primary border-primary/20" },
    admin: { label: "Admin", className: "bg-red-100 text-red-800 border-red-200" },
  } as const

  const role = user?.role ? roleConfig[user.role] : roleConfig.free

  return (
    <div className="mx-auto max-w-7xl px-4 py-12 sm:px-6 lg:px-8">
      {/* Welcome */}
      <div className="mb-10">
        <h1 className="text-3xl font-bold tracking-tight text-foreground sm:text-4xl">
          Welcome back, {user?.name ?? "Learner"}!
        </h1>
        <p className="mt-3 text-lg text-muted-foreground">
          Here is your learning dashboard. Track your progress and continue
          learning.
        </p>
      </div>

      <div className="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
        {/* User info card */}
        <Card>
          <CardHeader>
            <div className="flex items-center gap-3">
              <div className="flex h-12 w-12 items-center justify-center rounded-full bg-primary/10">
                <User className="h-6 w-6 text-primary" />
              </div>
              <div>
                <CardTitle className="text-lg">{user?.name}</CardTitle>
                <CardDescription>{user?.email}</CardDescription>
              </div>
            </div>
          </CardHeader>
          <CardContent>
            <div className="flex items-center gap-2">
              <span className="text-sm text-muted-foreground">Account type:</span>
              <Badge variant="outline" className={role.className}>
                {role.label}
              </Badge>
            </div>
            {user?.created_at && (
              <p className="mt-2 text-sm text-muted-foreground">
                Member since{" "}
                {new Date(user.created_at).toLocaleDateString("en-US", {
                  year: "numeric",
                  month: "long",
                })}
              </p>
            )}
          </CardContent>
        </Card>

        {/* Browse courses card */}
        <Card className="group hover:shadow-lg transition-shadow">
          <CardHeader>
            <div className="flex items-center gap-3">
              <div className="flex h-12 w-12 items-center justify-center rounded-full bg-blue-100">
                <BookOpen className="h-6 w-6 text-blue-600" />
              </div>
              <div>
                <CardTitle className="text-lg">Courses</CardTitle>
                <CardDescription>
                  Browse and enroll in courses
                </CardDescription>
              </div>
            </div>
          </CardHeader>
          <CardContent>
            <p className="text-sm text-muted-foreground mb-4">
              Explore our collection of courses covering web development, from
              beginner to advanced topics.
            </p>
            <Button asChild className="w-full">
              <Link to="/courses">
                <GraduationCap className="mr-2 h-4 w-4" />
                Browse Courses
              </Link>
            </Button>
          </CardContent>
        </Card>

        {/* Payment history card */}
        <Card className="group hover:shadow-lg transition-shadow">
          <CardHeader>
            <div className="flex items-center gap-3">
              <div className="flex h-12 w-12 items-center justify-center rounded-full bg-green-100">
                <CreditCard className="h-6 w-6 text-green-600" />
              </div>
              <div>
                <CardTitle className="text-lg">Payments</CardTitle>
                <CardDescription>
                  View your transaction history
                </CardDescription>
              </div>
            </div>
          </CardHeader>
          <CardContent>
            <p className="text-sm text-muted-foreground mb-4">
              Review your past purchases, check payment status, and manage your
              subscriptions.
            </p>
            <Button asChild variant="outline" className="w-full">
              <Link to="/payments">
                <CreditCard className="mr-2 h-4 w-4" />
                View Payment History
              </Link>
            </Button>
          </CardContent>
        </Card>
      </div>
    </div>
  )
}
