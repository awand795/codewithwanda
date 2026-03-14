import { useState, type FormEvent } from 'react'
import { Link } from 'react-router-dom'
import { useForgotPassword } from '@/hooks/useAuth'
import { toast } from '@/components/ui/use-toast'
import { Button } from '@/components/ui/button'
import { Input } from '@/components/ui/input'
import { Label } from '@/components/ui/label'
import {
  Card,
  CardContent,
  CardDescription,
  CardFooter,
  CardHeader,
  CardTitle,
} from '@/components/ui/card'

export default function ForgotPasswordForm() {
  const [email, setEmail] = useState('')

  const forgotPassword = useForgotPassword()

  function handleSubmit(e: FormEvent) {
    e.preventDefault()
    forgotPassword.mutate(
      { email },
      {
        onSuccess: () => {
          toast({
            title: 'Email sent',
            description: 'Check your inbox for the password reset link.',
          })
        },
      }
    )
  }

  const error = forgotPassword.error as {
    response?: { data?: { message?: string; errors?: Record<string, string[]> } }
  } | null

  return (
    <Card className="w-full max-w-md mx-auto">
      <CardHeader>
        <CardTitle className="text-2xl">Forgot Password</CardTitle>
        <CardDescription>
          Enter your email and we&apos;ll send you a reset link
        </CardDescription>
      </CardHeader>
      <form onSubmit={handleSubmit}>
        <CardContent className="space-y-4">
          {error?.response?.data?.message && (
            <div className="text-sm text-destructive bg-destructive/10 p-3 rounded-md">
              {error.response.data.message}
            </div>
          )}

          {forgotPassword.isSuccess && (
            <div className="text-sm text-green-600 bg-green-50 dark:bg-green-950/30 dark:text-green-400 p-3 rounded-md">
              A password reset link has been sent to your email address.
            </div>
          )}

          <div className="space-y-2">
            <Label htmlFor="email">Email</Label>
            <Input
              id="email"
              type="email"
              placeholder="you@example.com"
              value={email}
              onChange={(e) => setEmail(e.target.value)}
              required
            />
            {error?.response?.data?.errors?.email && (
              <p className="text-sm text-destructive">
                {error.response.data.errors.email[0]}
              </p>
            )}
          </div>
        </CardContent>

        <CardFooter className="flex flex-col gap-4">
          <Button type="submit" className="w-full" disabled={forgotPassword.isPending}>
            {forgotPassword.isPending ? 'Sending...' : 'Send Reset Link'}
          </Button>
          <p className="text-sm text-muted-foreground text-center">
            Remember your password?{' '}
            <Link to="/login" className="text-primary hover:underline underline-offset-4">
              Back to login
            </Link>
          </p>
        </CardFooter>
      </form>
    </Card>
  )
}
