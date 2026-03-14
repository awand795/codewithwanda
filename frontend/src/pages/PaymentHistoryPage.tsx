import { useState } from "react"
import { usePaymentHistory } from "@/hooks/usePayments"
import { Badge } from "@/components/ui/badge"
import { Button } from "@/components/ui/button"
import {
  Card,
  CardContent,
  CardHeader,
  CardTitle,
} from "@/components/ui/card"
import { Skeleton } from "@/components/ui/skeleton"
import { formatPrice } from "@/lib/utils"
import {
  ChevronLeft,
  ChevronRight,
  CreditCard,
  Receipt,
} from "lucide-react"
import type { Transaction } from "@/types"

const statusConfig: Record<
  Transaction["payment_status"],
  { label: string; variant: "default" | "secondary" | "destructive" | "outline" }
> = {
  pending: { label: "Pending", variant: "secondary" },
  settlement: { label: "Paid", variant: "default" },
  expire: { label: "Expired", variant: "outline" },
  cancel: { label: "Cancelled", variant: "destructive" },
  deny: { label: "Denied", variant: "destructive" },
  refund: { label: "Refunded", variant: "outline" },
}

function PaymentStatus({ status }: { status: Transaction["payment_status"] }) {
  const config = statusConfig[status] ?? { label: status, variant: "outline" as const }
  return <Badge variant={config.variant}>{config.label}</Badge>
}

function PaymentHistorySkeleton() {
  return (
    <div className="space-y-4">
      {Array.from({ length: 5 }).map((_, i) => (
        <div key={i} className="flex items-center gap-4 rounded-lg border p-4">
          <Skeleton className="h-10 w-10 rounded-full" />
          <div className="flex-1 space-y-2">
            <Skeleton className="h-5 w-48" />
            <Skeleton className="h-4 w-32" />
          </div>
          <Skeleton className="h-5 w-20" />
          <Skeleton className="h-5 w-24" />
        </div>
      ))}
    </div>
  )
}

export default function PaymentHistoryPage() {
  const [page, setPage] = useState(1)
  const { data, isLoading, error } = usePaymentHistory(page)

  const transactions = data?.data ?? []
  const meta = data?.meta

  return (
    <div className="mx-auto max-w-4xl px-4 py-12 sm:px-6 lg:px-8">
      <div className="mb-10">
        <h1 className="text-3xl font-bold tracking-tight text-foreground sm:text-4xl">
          Payment History
        </h1>
        <p className="mt-3 text-lg text-muted-foreground">
          View your past transactions and payment status.
        </p>
      </div>

      {isLoading && <PaymentHistorySkeleton />}

      {error && (
        <div className="text-center py-16">
          <p className="text-destructive">
            Failed to load payment history. Please try again later.
          </p>
        </div>
      )}

      {!isLoading && !error && transactions.length === 0 && (
        <div className="text-center py-16">
          <Receipt className="mx-auto h-16 w-16 text-muted-foreground/40 mb-4" />
          <h3 className="text-lg font-semibold text-muted-foreground">
            No transactions yet
          </h3>
          <p className="text-sm text-muted-foreground/70 mt-1">
            Your payment history will appear here once you make a purchase.
          </p>
        </div>
      )}

      {!isLoading && !error && transactions.length > 0 && (
        <div className="space-y-6">
          {/* Transaction list */}
          <Card>
            <CardHeader>
              <CardTitle className="text-lg flex items-center gap-2">
                <CreditCard className="h-5 w-5" />
                Transactions
              </CardTitle>
            </CardHeader>
            <CardContent>
              <div className="divide-y">
                {transactions.map((transaction) => (
                  <div
                    key={transaction.id}
                    className="flex flex-col gap-3 py-4 first:pt-0 last:pb-0 sm:flex-row sm:items-center sm:justify-between"
                  >
                    <div className="flex-1 min-w-0">
                      <p className="font-medium text-sm truncate">
                        {transaction.course?.title ?? `Order #${transaction.order_id}`}
                      </p>
                      <p className="text-xs text-muted-foreground mt-0.5">
                        {new Date(transaction.created_at).toLocaleDateString("en-US", {
                          year: "numeric",
                          month: "long",
                          day: "numeric",
                        })}
                        {transaction.payment_type && (
                          <span className="ml-2">
                            via {transaction.payment_type}
                          </span>
                        )}
                      </p>
                    </div>

                    <div className="flex items-center gap-4">
                      <PaymentStatus status={transaction.payment_status} />
                      <span className="text-sm font-semibold whitespace-nowrap">
                        {formatPrice(transaction.amount)}
                      </span>
                    </div>
                  </div>
                ))}
              </div>
            </CardContent>
          </Card>

          {/* Pagination */}
          {meta && meta.last_page > 1 && (
            <div className="flex items-center justify-center gap-2">
              <Button
                variant="outline"
                size="sm"
                onClick={() => setPage((p) => Math.max(1, p - 1))}
                disabled={page <= 1}
              >
                <ChevronLeft className="h-4 w-4" />
                Previous
              </Button>
              <span className="text-sm text-muted-foreground px-4">
                Page {meta.current_page} of {meta.last_page}
              </span>
              <Button
                variant="outline"
                size="sm"
                onClick={() => setPage((p) => p + 1)}
                disabled={page >= meta.last_page}
              >
                Next
                <ChevronRight className="h-4 w-4" />
              </Button>
            </div>
          )}
        </div>
      )}
    </div>
  )
}
