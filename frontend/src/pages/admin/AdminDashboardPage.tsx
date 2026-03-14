import { useQuery } from "@tanstack/react-query"
import { BookOpen, Users, DollarSign, Folder, TrendingUp, Clock } from "lucide-react"
import { Card, CardContent, CardHeader, CardTitle } from "@/components/ui/card"
import { Badge } from "@/components/ui/badge"
import api from "@/api/axios"

interface DashboardStats {
  total_courses: number
  published_courses: number
  unpublished_courses: number
  total_categories: number
  total_students: number
  premium_students: number
  total_revenue: number
  pending_transactions: number
  recent_transactions: Array<{
    id: number
    order_id: string
    amount: number
    payment_status: string
    user_name: string
    course_title: string
    created_at: string
  }>
}

function formatPrice(price: number): string {
  return new Intl.NumberFormat('id-ID', {
    style: 'currency',
    currency: 'IDR',
    minimumFractionDigits: 0,
  }).format(price)
}

function formatDate(dateString: string): string {
  return new Date(dateString).toLocaleDateString('en-US', {
    month: 'short',
    day: 'numeric',
    year: 'numeric',
  })
}

function getStatusBadgeVariant(status: string): "default" | "secondary" | "destructive" | "outline" {
  switch (status) {
    case "settlement":
      return "default"
    case "pending":
      return "secondary"
    case "expire":
    case "cancel":
    case "deny":
    case "refund":
      return "destructive"
    default:
      return "outline"
  }
}

const StatCard = ({ title, value, icon: Icon, trend, color }: { 
  title: string
  value: string | number
  icon: any
  trend?: string
  color: string
}) => (
  <Card>
    <CardHeader className="flex flex-row items-center justify-between space-y-0 pb-2">
      <CardTitle className="text-sm font-medium text-muted-foreground">{title}</CardTitle>
      <Icon className={`h-4 w-4 ${color}`} />
    </CardHeader>
    <CardContent>
      <div className="text-2xl font-bold">{value}</div>
      {trend && (
        <p className="text-xs text-muted-foreground mt-1 flex items-center">
          <TrendingUp className="h-3 w-3 mr-1" />
          {trend}
        </p>
      )}
    </CardContent>
  </Card>
)

export default function AdminDashboardPage() {
  const { data, isLoading, error } = useQuery<{ data: DashboardStats }>({
    queryKey: ["admin-dashboard"],
    queryFn: async () => {
      const { data } = await api.get("/admin/dashboard")
      return data
    },
  })

  if (isLoading) {
    return (
      <div className="space-y-6">
        <div className="grid gap-4 md:grid-cols-2 lg:grid-cols-4">
          {Array.from({ length: 4 }).map((_, i) => (
            <Card key={i}>
              <CardHeader className="flex flex-row items-center justify-between space-y-0 pb-2">
                <div className="h-4 w-24 bg-muted rounded" />
                <div className="h-4 w-4 bg-muted rounded" />
              </CardHeader>
              <CardContent>
                <div className="h-8 w-16 bg-muted rounded" />
              </CardContent>
            </Card>
          ))}
        </div>
      </div>
    )
  }

  if (error) {
    return (
      <div className="text-center py-16">
        <p className="text-destructive">Failed to load dashboard data.</p>
      </div>
    )
  }

  const stats = data?.data

  return (
    <div className="space-y-6">
      {/* Stats Grid */}
      <div className="grid gap-4 md:grid-cols-2 lg:grid-cols-4">
        <StatCard
          title="Total Courses"
          value={stats?.total_courses || 0}
          icon={BookOpen}
          color="text-blue-500"
        />
        <StatCard
          title="Published Courses"
          value={stats?.published_courses || 0}
          icon={BookOpen}
          trend={`${stats?.unpublished_courses || 0} unpublished`}
          color="text-green-500"
        />
        <StatCard
          title="Categories"
          value={stats?.total_categories || 0}
          icon={Folder}
          color="text-purple-500"
        />
        <StatCard
          title="Total Students"
          value={stats?.total_students || 0}
          icon={Users}
          trend={`${stats?.premium_students || 0} premium`}
          color="text-orange-500"
        />
      </div>

      {/* Revenue and Transactions */}
      <div className="grid gap-4 md:grid-cols-2">
        <Card>
          <CardHeader>
            <CardTitle className="flex items-center gap-2">
              <DollarSign className="h-5 w-5 text-green-500" />
              Total Revenue
            </CardTitle>
          </CardHeader>
          <CardContent>
            <div className="text-3xl font-bold">
              {formatPrice(stats?.total_revenue || 0)}
            </div>
            <p className="text-sm text-muted-foreground mt-2">
              From all completed transactions
            </p>
          </CardContent>
        </Card>

        <Card>
          <CardHeader>
            <CardTitle className="flex items-center gap-2">
              <Clock className="h-5 w-5 text-yellow-500" />
              Pending Transactions
            </CardTitle>
          </CardHeader>
          <CardContent>
            <div className="text-3xl font-bold">
              {stats?.pending_transactions || 0}
            </div>
            <p className="text-sm text-muted-foreground mt-2">
              Awaiting payment confirmation
            </p>
          </CardContent>
        </Card>
      </div>

      {/* Recent Transactions */}
      <Card>
        <CardHeader>
          <CardTitle>Recent Transactions</CardTitle>
        </CardHeader>
        <CardContent>
          {stats?.recent_transactions && stats.recent_transactions.length > 0 ? (
            <div className="overflow-x-auto">
              <table className="w-full">
                <thead>
                  <tr className="border-b text-sm text-muted-foreground">
                    <th className="text-left py-3 px-4 font-medium">Order ID</th>
                    <th className="text-left py-3 px-4 font-medium">User</th>
                    <th className="text-left py-3 px-4 font-medium">Course</th>
                    <th className="text-left py-3 px-4 font-medium">Amount</th>
                    <th className="text-left py-3 px-4 font-medium">Status</th>
                    <th className="text-left py-3 px-4 font-medium">Date</th>
                  </tr>
                </thead>
                <tbody>
                  {stats.recent_transactions.map((transaction) => (
                    <tr key={transaction.id} className="border-b last:border-0 hover:bg-muted/50">
                      <td className="py-3 px-4 text-sm font-mono">#{transaction.order_id}</td>
                      <td className="py-3 px-4 text-sm">{transaction.user_name}</td>
                      <td className="py-3 px-4 text-sm">{transaction.course_title}</td>
                      <td className="py-3 px-4 text-sm font-medium">
                        {formatPrice(transaction.amount)}
                      </td>
                      <td className="py-3 px-4">
                        <Badge variant={getStatusBadgeVariant(transaction.payment_status)}>
                          {transaction.payment_status}
                        </Badge>
                      </td>
                      <td className="py-3 px-4 text-sm text-muted-foreground">
                        {formatDate(transaction.created_at)}
                      </td>
                    </tr>
                  ))}
                </tbody>
              </table>
            </div>
          ) : (
            <p className="text-muted-foreground text-center py-8">
              No recent transactions
            </p>
          )}
        </CardContent>
      </Card>
    </div>
  )
}
