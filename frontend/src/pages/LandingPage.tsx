import { useNavigate } from 'react-router-dom'
import { useLanding } from "@/hooks/useLanding"
import { BookOpen, Code, Award, Users, Zap, Globe, ArrowRight, PlayCircle } from "lucide-react"
import { Button } from "@/components/ui/button"
import { Card, CardContent } from "@/components/ui/card"
import { Badge } from "@/components/ui/badge"
import { Skeleton } from "@/components/ui/skeleton"
import { CourseCard } from "@/components/courses/CourseCard"

function LandingPageSkeleton() {
  return (
    <div className="space-y-24">
      {/* Hero skeleton */}
      <div className="relative overflow-hidden">
        <div className="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-24 sm:py-32">
          <div className="mx-auto max-w-3xl space-y-6 text-center">
            <Skeleton className="mx-auto h-8 w-48" />
            <Skeleton className="mx-auto h-16 w-full" />
            <Skeleton className="mx-auto h-16 w-3/4" />
            <Skeleton className="mx-auto h-8 w-full max-w-xl" />
            <div className="flex justify-center gap-4 pt-8">
              <Skeleton className="h-12 w-40" />
              <Skeleton className="h-12 w-40" />
            </div>
          </div>
        </div>
      </div>
    </div>
  )
}

function HeroSection({ stats }: { stats?: any }) {
  const navigate = useNavigate()

  return (
    <div className="relative overflow-hidden bg-gradient-to-br from-slate-900 via-blue-900 to-slate-900">
      {/* Animated background elements */}
      <div className="absolute inset-0 overflow-hidden">
        <div className="absolute -top-40 -right-40 w-80 h-80 bg-blue-500 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-blob"></div>
        <div className="absolute -bottom-40 -left-40 w-80 h-80 bg-purple-500 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-blob animation-delay-2000"></div>
        <div className="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-80 h-80 bg-cyan-500 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-blob animation-delay-4000"></div>
      </div>

      <div className="relative mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-24 sm:py-32">
        <div className="mx-auto max-w-4xl text-center">
          <Badge variant="secondary" className="mb-6 px-4 py-2 text-sm">
            <Zap className="h-4 w-4 mr-2 inline" />
            Start Learning Today
          </Badge>

          <h1 className="text-4xl sm:text-5xl lg:text-7xl font-bold text-white tracking-tight mb-8">
            Master New Skills with{' '}
            <span className="bg-gradient-to-r from-blue-400 to-cyan-400 bg-clip-text text-transparent">
              Interactive Courses
            </span>
          </h1>

          <p className="text-lg sm:text-xl text-gray-300 mb-10 max-w-3xl mx-auto leading-relaxed">
            Learn web development with hands-on coding exercises, real-time feedback, and 
            professional courses taught by industry experts.
          </p>

          <div className="flex flex-col sm:flex-row gap-4 justify-center items-center">
            <Button 
              size="lg" 
              onClick={() => navigate('/courses')}
              className="h-14 px-8 text-lg bg-gradient-to-r from-blue-600 to-cyan-600 hover:from-blue-700 hover:to-cyan-700 border-0 shadow-lg shadow-blue-500/25"
            >
              Explore Courses
              <ArrowRight className="ml-2 h-5 w-5" />
            </Button>
            <Button 
              size="lg" 
              variant="outline"
              onClick={() => navigate('/register')}
              className="h-14 px-8 text-lg border-2 border-white/20 hover:bg-white/10 text-white"
            >
              Start Free Trial
              <PlayCircle className="ml-2 h-5 w-5" />
            </Button>
          </div>

          {/* Stats */}
          {stats && (
            <div className="grid grid-cols-2 md:grid-cols-4 gap-8 mt-16 pt-16 border-t border-white/10">
              <div className="text-center">
                <div className="text-3xl sm:text-4xl font-bold text-white mb-2">
                  {stats.total_courses}+
                </div>
                <div className="text-sm text-gray-400">Courses</div>
              </div>
              <div className="text-center">
                <div className="text-3xl sm:text-4xl font-bold text-white mb-2">
                  {stats.total_lessons}+
                </div>
                <div className="text-sm text-gray-400">Lessons</div>
              </div>
              <div className="text-center">
                <div className="text-3xl sm:text-4xl font-bold text-white mb-2">
                  {stats.total_students}+
                </div>
                <div className="text-sm text-gray-400">Students</div>
              </div>
              <div className="text-center">
                <div className="text-3xl sm:text-4xl font-bold text-white mb-2">
                  {stats.total_categories}
                </div>
                <div className="text-sm text-gray-400">Categories</div>
              </div>
            </div>
          )}
        </div>
      </div>
    </div>
  )
}

function FeatureCards() {
  const features = [
    {
      icon: Code,
      title: 'Interactive Coding',
      description: 'Practice with our built-in code editor and see results instantly.',
      color: 'from-blue-500 to-cyan-500',
    },
    {
      icon: BookOpen,
      title: 'Comprehensive Content',
      description: 'From basics to advanced, structured learning paths for all levels.',
      color: 'from-purple-500 to-pink-500',
    },
    {
      icon: Award,
      title: 'Earn Certificates',
      description: 'Get certified upon completion and showcase your achievements.',
      color: 'from-orange-500 to-red-500',
    },
    {
      icon: Users,
      title: 'Community Support',
      description: 'Join thousands of learners and get help when you need it.',
      color: 'from-green-500 to-emerald-500',
    },
    {
      icon: Zap,
      title: 'Real-time Feedback',
      description: 'Get instant feedback on your code with automated testing.',
      color: 'from-yellow-500 to-orange-500',
    },
    {
      icon: Globe,
      title: 'Learn Anywhere',
      description: 'Access courses on any device, anytime, anywhere.',
      color: 'from-indigo-500 to-purple-500',
    },
  ]

  return (
    <div className="py-24 bg-white">
      <div className="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div className="text-center mb-16">
          <Badge variant="secondary" className="mb-4">
            Why Choose Us
          </Badge>
          <h2 className="text-3xl sm:text-4xl font-bold mb-4">
            Everything You Need to Succeed
          </h2>
          <p className="text-lg text-muted-foreground max-w-2xl mx-auto">
            Our platform provides all the tools and resources you need to master new skills.
          </p>
        </div>

        <div className="grid gap-8 md:grid-cols-2 lg:grid-cols-3">
          {features.map((feature, index) => (
            <Card 
              key={index}
              className="group relative overflow-hidden border-0 shadow-lg hover:shadow-xl transition-all duration-300 hover:-translate-y-1"
            >
              <CardContent className="p-8">
                <div className={`inline-flex p-3 rounded-xl bg-gradient-to-r ${feature.color} mb-6`}>
                  <feature.icon className="h-6 w-6 text-white" />
                </div>
                <h3 className="text-xl font-semibold mb-3">{feature.title}</h3>
                <p className="text-muted-foreground leading-relaxed">
                  {feature.description}
                </p>
              </CardContent>
            </Card>
          ))}
        </div>
      </div>
    </div>
  )
}

function FeaturedCourses({ courses }: { courses: any[] }) {
  const navigate = useNavigate()

  return (
    <div className="py-24 bg-gradient-to-b from-gray-50 to-white">
      <div className="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div className="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-12">
          <div>
            <Badge variant="secondary" className="mb-4">
              Popular Courses
            </Badge>
            <h2 className="text-3xl sm:text-4xl font-bold mb-2">
              Featured Learning Paths
            </h2>
            <p className="text-lg text-muted-foreground">
              Hand-picked courses to kickstart your journey
            </p>
          </div>
          <Button 
            variant="outline" 
            onClick={() => navigate('/courses')}
            className="shrink-0"
          >
            View All Courses
            <ArrowRight className="ml-2 h-4 w-4" />
          </Button>
        </div>

        <div className="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
          {courses.slice(0, 6).map((course) => (
            <CourseCard key={course.id} course={course} />
          ))}
        </div>
      </div>
    </div>
  )
}

function LearningPaths({ categories }: { categories: any[] }) {
  const navigate = useNavigate()

  return (
    <div className="py-24 bg-white">
      <div className="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div className="text-center mb-16">
          <Badge variant="secondary" className="mb-4">
            Learning Paths
          </Badge>
          <h2 className="text-3xl sm:text-4xl font-bold mb-4">
            Choose Your Path
          </h2>
          <p className="text-lg text-muted-foreground max-w-2xl mx-auto">
            Structured learning paths designed by industry experts
          </p>
        </div>

        <div className="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
          {categories.map((category) => (
            <Card 
              key={category.id}
              className="group cursor-pointer border-2 hover:border-primary transition-all duration-300 hover:shadow-lg"
              onClick={() => navigate(`/categories/${category.slug}`)}
            >
              <CardContent className="p-6">
                <div className="flex items-start gap-4">
                  <div className="flex h-14 w-14 rounded-xl bg-gradient-to-br from-blue-500 to-cyan-500 items-center justify-center shrink-0">
                    <span className="text-2xl text-white">
                      {category.icon?.charAt(0).toUpperCase() || 'C'}
                    </span>
                  </div>
                  <div className="flex-1 min-w-0">
                    <h3 className="text-xl font-semibold mb-2 group-hover:text-primary transition-colors">
                      {category.name}
                    </h3>
                    <p className="text-sm text-muted-foreground mb-3 line-clamp-2">
                      {category.description}
                    </p>
                    <div className="flex items-center gap-4 text-sm text-gray-500">
                      <span className="flex items-center gap-1">
                        <BookOpen className="h-4 w-4" />
                        {category.courses_count || 0} courses
                      </span>
                    </div>
                  </div>
                </div>
              </CardContent>
            </Card>
          ))}
        </div>
      </div>
    </div>
  )
}

function CTASection() {
  const navigate = useNavigate()

  return (
    <div className="py-24 bg-gradient-to-br from-slate-900 via-blue-900 to-slate-900 relative overflow-hidden">
      {/* Background decoration */}
      <div className="absolute inset-0 overflow-hidden">
        <div className="absolute -top-40 -right-40 w-80 h-80 bg-blue-500 rounded-full mix-blend-multiply filter blur-3xl opacity-20"></div>
        <div className="absolute -bottom-40 -left-40 w-80 h-80 bg-purple-500 rounded-full mix-blend-multiply filter blur-3xl opacity-20"></div>
      </div>

      <div className="relative mx-auto max-w-4xl px-4 sm:px-6 lg:px-8 text-center">
        <h2 className="text-3xl sm:text-4xl lg:text-5xl font-bold text-white mb-6">
          Ready to Start Your Learning Journey?
        </h2>
        <p className="text-xl text-gray-300 mb-10 max-w-2xl mx-auto">
          Join thousands of students already learning on our platform. 
          Start with free courses today!
        </p>
        <div className="flex flex-col sm:flex-row gap-4 justify-center">
          <Button 
            size="lg"
            onClick={() => navigate('/register')}
            className="h-14 px-8 text-lg bg-white text-slate-900 hover:bg-gray-100"
          >
            Get Started Free
            <ArrowRight className="ml-2 h-5 w-5" />
          </Button>
          <Button 
            size="lg"
            variant="outline"
            onClick={() => navigate('/login')}
            className="h-14 px-8 text-lg border-2 border-white/20 hover:bg-white/10 text-white"
          >
            Sign In
          </Button>
        </div>
      </div>
    </div>
  )
}

function Footer() {
  return (
    <footer className="bg-gray-900 text-gray-300 py-12 border-t border-gray-800">
      <div className="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div className="grid gap-8 md:grid-cols-4">
          <div className="col-span-2 md:col-span-1">
            <h3 className="text-xl font-bold text-white mb-4">LearnPath</h3>
            <p className="text-sm text-gray-400 mb-4">
              Master new skills with interactive courses and hands-on projects.
            </p>
            <div className="flex gap-4">
              <a href="#" className="text-gray-400 hover:text-white transition-colors">
                <span className="sr-only">GitHub</span>
                <svg className="h-6 w-6" fill="currentColor" viewBox="0 0 24 24"><path d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z"/></svg>
              </a>
              <a href="#" className="text-gray-400 hover:text-white transition-colors">
                <span className="sr-only">Twitter</span>
                <svg className="h-6 w-6" fill="currentColor" viewBox="0 0 24 24"><path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/></svg>
              </a>
            </div>
          </div>

          <div>
            <h4 className="font-semibold text-white mb-4">Learning</h4>
            <ul className="space-y-2 text-sm">
              <li><a href="/courses" className="hover:text-white transition-colors">Browse Courses</a></li>
              <li><a href="/categories" className="hover:text-white transition-colors">Categories</a></li>
              <li><a href="#" className="hover:text-white transition-colors">Learning Paths</a></li>
              <li><a href="#" className="hover:text-white transition-colors">Certifications</a></li>
            </ul>
          </div>

          <div>
            <h4 className="font-semibold text-white mb-4">Company</h4>
            <ul className="space-y-2 text-sm">
              <li><a href="#" className="hover:text-white transition-colors">About Us</a></li>
              <li><a href="#" className="hover:text-white transition-colors">Careers</a></li>
              <li><a href="#" className="hover:text-white transition-colors">Blog</a></li>
              <li><a href="#" className="hover:text-white transition-colors">Contact</a></li>
            </ul>
          </div>

          <div>
            <h4 className="font-semibold text-white mb-4">Support</h4>
            <ul className="space-y-2 text-sm">
              <li><a href="#" className="hover:text-white transition-colors">Help Center</a></li>
              <li><a href="#" className="hover:text-white transition-colors">FAQs</a></li>
              <li><a href="#" className="hover:text-white transition-colors">Privacy Policy</a></li>
              <li><a href="#" className="hover:text-white transition-colors">Terms of Service</a></li>
            </ul>
          </div>
        </div>

        <div className="mt-12 pt-8 border-t border-gray-800 text-center text-sm text-gray-400">
          <p>&copy; 2024 LearnPath. All rights reserved.</p>
        </div>
      </div>
    </footer>
  )
}

export default function LandingPage() {
  const { data, isLoading } = useLanding()

  if (isLoading) {
    return <LandingPageSkeleton />
  }

  return (
    <div>
      <HeroSection stats={data?.stats} />
      <FeatureCards />
      {data?.featured_courses && (
        <FeaturedCourses courses={data.featured_courses} />
      )}
      {data?.categories && (
        <LearningPaths categories={data.categories} />
      )}
      <CTASection />
      <Footer />
    </div>
  )
}
