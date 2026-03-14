import { Badge } from "@/components/ui/badge"
import { Card, CardContent, CardHeader, CardTitle } from "@/components/ui/card"
import { formatPrice } from "@/lib/utils"
import type { Transaction } from "@/types"

const statusConfig = {
  settlement: { label: "Paid", className: "bg-green-100 text-green-800 border-green-200" },
  pending: { label: "Pending", className: "bg-yellow-100 text-yellow-800 border-yellow-200" },
  expire: { label: "Expired", className: "bg-red-100 text-red-800 border-red-200" },
  cancel: { label: "Cancelled", className: "bg-red-100 text-red-800 border-red-200" },
  deny: { label: "Denied", className: "bg-red-100 text-red-800 border-red-200" },
  refund: { label: "Refunded", className: "bg-gray-100 text-gray-800 border-gray-200" },
} as const

interface PaymentStatusProps {
  transaction: Transaction
}

export function PaymentStatus({ transaction }: PaymentStatusProps) {
  const status = statusConfig[transaction.payment_status]

  return (
    <Card>
      <CardHeader className="pb-3">
        <div className="flex items-center justify-between">
          <CardTitle className="text-base">Transaction Details</CardTitle>
          <Badge variant="outline" className={status.className}>
            {status.label}
          </Badge>
        </div>
      </CardHeader>
      <CardContent>
        <dl className="grid grid-cols-2 gap-x-4 gap-y-3 text-sm">
          <div>
            <dt className="text-muted-foreground">Order ID</dt>
            <dd className="font-mono font-medium">{transaction.order_id}</dd>
          </div>
          <div>
            <dt className="text-muted-foreground">Amount</dt>
            <dd className="font-medium">{formatPrice(transaction.amount)}</dd>
          </div>
          {transaction.payment_type && (
            <div>
              <dt className="text-muted-foreground">Payment Type</dt>
              <dd className="font-medium capitalize">
                {transaction.payment_type.replace(/_/g, " ")}
              </dd>
            </div>
          )}
          <div>
            <dt className="text-muted-foreground">Date</dt>
            <dd className="font-medium">
              {new Date(
                transaction.paid_at ?? transaction.created_at
              ).toLocaleDateString("id-ID", {
                day: "numeric",
                month: "long",
                year: "numeric",
              })}
            </dd>
          </div>
        </dl>
      </CardContent>
    </Card>
  )
}
