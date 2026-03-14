import { Outlet, useNavigate } from "react-router-dom"
import { useEffect } from "react"
import { useAuthStore } from "@/stores/authStore"

export default function AdminProtectedRoute() {
  const { isAuthenticated, user } = useAuthStore()
  const navigate = useNavigate()

  useEffect(() => {
    if (!isAuthenticated || user?.role !== "admin") {
      navigate("/admin/login", { replace: true })
    }
  }, [isAuthenticated, user, navigate])

  if (!isAuthenticated || user?.role !== "admin") {
    return null
  }

  return <Outlet />
}
