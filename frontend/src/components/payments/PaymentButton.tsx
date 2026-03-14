import { useState } from "react"
import { Loader2 } from "lucide-react"
import { Button } from "@/components/ui/button"
import { useCreatePayment } from "@/hooks/usePayments"
import { formatPrice } from "@/lib/utils"
import { toast } from "@/components/ui/use-toast"
import { loadMidtransScript, snapPay } from "@/lib/midtrans"

interface PaymentButtonProps {
  courseId: number
  price: number
}

export function PaymentButton({ courseId, price }: PaymentButtonProps) {
  const [isProcessing, setIsProcessing] = useState(false)
  const createPayment = useCreatePayment()

  async function handlePayment() {
    try {
      setIsProcessing(true)

      const { data } = await createPayment.mutateAsync(courseId)
      const snapToken = data.snap_token

      await loadMidtransScript()
      const result = await snapPay(snapToken)

      if (result.status === 'success') {
        toast({
          title: "Payment Successful",
          description: "You now have access to the course.",
        })
        window.location.reload()
      } else if (result.status === 'pending') {
        toast({
          title: "Payment Pending",
          description: "Your payment is being processed.",
        })
      } else if (result.status === 'close') {
        return
      } else {
        toast({
          title: "Payment Failed",
          description: "Payment was not successful. Please try again.",
          variant: "destructive",
        })
      }
    } catch (error) {
      // User may have closed the payment popup - don't show error for that
      if (error instanceof Error && error.message === "closed") {
        return
      }

      toast({
        title: "Payment Failed",
        description:
          error instanceof Error
            ? error.message
            : "Something went wrong. Please try again.",
        variant: "destructive",
      })
    } finally {
      setIsProcessing(false)
    }
  }

  const isLoading = createPayment.isPending || isProcessing

  return (
    <Button
      onClick={handlePayment}
      disabled={isLoading}
      className="w-full"
      size="lg"
    >
      {isLoading ? (
        <>
          <Loader2 className="h-4 w-4 animate-spin" />
          Processing...
        </>
      ) : (
        `Buy Now - ${formatPrice(price)}`
      )}
    </Button>
  )
}
