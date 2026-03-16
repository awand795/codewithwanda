import { useState } from 'react'
import { Card, CardContent, CardDescription, CardHeader, CardTitle } from '@/components/ui/card'
import { Button } from '@/components/ui/button'
import { CheckCircle2, XCircle, ChevronRight, RotateCcw, Trophy, Sparkles } from 'lucide-react'
import type { QuizQuestion } from '@/types'

interface QuizProps {
  questions: QuizQuestion[]
  onComplete?: (score: number) => void
}

export function Quiz({ questions, onComplete }: QuizProps) {
  const [currentQuestion, setCurrentQuestion] = useState(0)
  const [selectedAnswer, setSelectedAnswer] = useState<number | null>(null)
  const [showExplanation, setShowExplanation] = useState(false)
  const [answers, setAnswers] = useState<(number | null)[]>([])
  const [completed, setCompleted] = useState(false)

  const question = questions[currentQuestion]
  const isLastQuestion = currentQuestion === questions.length - 1

  const handleSelectAnswer = (index: number) => {
    if (showExplanation) return
    setSelectedAnswer(index)
  }

  const handleSubmitAnswer = () => {
    if (selectedAnswer === null) return
    setShowExplanation(true)
    const newAnswers = [...answers]
    newAnswers[currentQuestion] = selectedAnswer
    setAnswers(newAnswers)
  }

  const handleNextQuestion = () => {
    if (isLastQuestion) {
      const score = answers.filter((a, i) => a === questions[i].correct).length
      setCompleted(true)
      onComplete?.(score)
    } else {
      setCurrentQuestion(currentQuestion + 1)
      setSelectedAnswer(null)
      setShowExplanation(false)
    }
  }

  const handleRetry = () => {
    setCurrentQuestion(0)
    setSelectedAnswer(null)
    setShowExplanation(false)
    setAnswers([])
    setCompleted(false)
  }

  if (completed) {
    const score = answers.filter((a, i) => a === questions[i].correct).length
    const percentage = Math.round((score / questions.length) * 100)
    const isPassing = percentage >= 70

    return (
      <Card className="border-0 shadow-xl bg-gradient-to-br from-purple-50 to-pink-50">
        <CardHeader className="text-center pb-6">
          <div className="mx-auto mb-6 flex h-20 w-20 items-center justify-center rounded-full bg-white shadow-lg">
            {isPassing ? (
              <Trophy className="h-10 w-10 text-yellow-500" />
            ) : (
              <RotateCcw className="h-10 w-10 text-purple-500" />
            )}
          </div>
          <CardTitle className="text-3xl">
            {isPassing ? '🎉 Excellent!' : '💪 Keep Learning!'}
          </CardTitle>
          <CardDescription className="text-base mt-2">
            {isPassing 
              ? 'Great job! You have a good understanding of this lesson.'
              : 'Review the lesson content and try again!'}
          </CardDescription>
        </CardHeader>
        <CardContent className="flex flex-col items-center gap-6">
          <div className="flex items-center gap-4">
            <div className="text-center">
              <div className="text-4xl font-bold text-purple-600">{score}</div>
              <div className="text-sm text-muted-foreground">Correct</div>
            </div>
            <div className="w-px h-12 bg-gray-200"></div>
            <div className="text-center">
              <div className="text-4xl font-bold text-gray-900">{questions.length}</div>
              <div className="text-sm text-muted-foreground">Total</div>
            </div>
            <div className="w-px h-12 bg-gray-200"></div>
            <div className="text-center">
              <div className={`text-4xl font-bold ${isPassing ? 'text-green-600' : 'text-orange-500'}`}>
                {percentage}%
              </div>
              <div className="text-sm text-muted-foreground">Score</div>
            </div>
          </div>
          
          <div className="w-full bg-gray-200 rounded-full h-3 mt-4">
            <div 
              className={`h-3 rounded-full transition-all duration-500 ${
                isPassing ? 'bg-gradient-to-r from-green-400 to-green-600' : 'bg-gradient-to-r from-orange-400 to-orange-600'
              }`}
              style={{ width: `${percentage}%` }}
            />
          </div>

          <Button onClick={handleRetry} variant="outline" size="lg" className="mt-4">
            <RotateCcw className="mr-2 h-4 w-4" />
            Retry Quiz
          </Button>
        </CardContent>
      </Card>
    )
  }

  return (
    <Card className="border-0 shadow-xl">
      <CardHeader className="border-b bg-gradient-to-r from-purple-50 to-pink-50 pb-6">
        <div className="flex items-center justify-between">
          <div className="flex items-center gap-3">
            <div className="p-2 bg-purple-100 rounded-lg">
              <Sparkles className="h-5 w-5 text-purple-600" />
            </div>
            <div>
              <CardTitle className="text-2xl">Quiz Time</CardTitle>
              <CardDescription className="text-sm">
                Question {currentQuestion + 1} of {questions.length}
              </CardDescription>
            </div>
          </div>
          <div className="text-sm text-muted-foreground">
            {answers.filter((a, i) => a === questions[i].correct).length} correct so far
          </div>
        </div>
        
        {/* Progress Bar */}
        <div className="w-full bg-gray-200 rounded-full h-2 mt-4">
          <div 
            className="h-2 rounded-full bg-gradient-to-r from-purple-400 to-pink-400 transition-all duration-300"
            style={{ width: `${((currentQuestion + 1) / questions.length) * 100}%` }}
          />
        </div>
      </CardHeader>
      <CardContent className="p-6">
        <div className="space-y-6">
          <p className="font-medium text-lg text-gray-900 leading-relaxed">
            {question.question}
          </p>

          <div className="space-y-3">
            {question.options.map((option, index) => {
              let buttonVariant = "outline" as const
              let buttonColor = ""
              let showIcon = false

              if (showExplanation) {
                if (index === question.correct) {
                  buttonVariant = "default" as const
                  buttonColor = "bg-green-600 hover:bg-green-700 border-green-600"
                  showIcon = true
                } else if (index === selectedAnswer && index !== question.correct) {
                  buttonVariant = "destructive" as const
                  showIcon = true
                }
              } else if (selectedAnswer === index) {
                buttonVariant = "secondary" as const
                buttonColor = "border-purple-400"
              }

              return (
                <Button
                  key={index}
                  variant={buttonVariant}
                  className={`w-full justify-start h-auto py-4 px-5 text-base ${buttonColor} transition-all duration-200`}
                  onClick={() => handleSelectAnswer(index)}
                  disabled={showExplanation}
                >
                  <span className="mr-3 font-bold text-lg min-w-[28px]">
                    {String.fromCharCode(65 + index)}.
                  </span>
                  <span className="flex-1">{option}</span>
                  {showIcon && index === question.correct && (
                    <CheckCircle2 className="h-6 w-6 ml-2" />
                  )}
                  {showIcon && index === selectedAnswer && index !== question.correct && (
                    <XCircle className="h-6 w-6 ml-2" />
                  )}
                </Button>
              )
            })}
          </div>

          {showExplanation && (
            <div className={`mt-6 rounded-lg p-5 border-l-4 ${
              selectedAnswer === question.correct 
                ? 'bg-green-50 border-green-500' 
                : 'bg-red-50 border-red-500'
            }`}>
              <p className="font-bold text-lg mb-2 flex items-center gap-2">
                {selectedAnswer === question.correct ? (
                  <>
                    <CheckCircle2 className="h-5 w-5 text-green-600" />
                    <span className="text-green-800">Correct!</span>
                  </>
                ) : (
                  <>
                    <XCircle className="h-5 w-5 text-red-600" />
                    <span className="text-red-800">Incorrect</span>
                  </>
                )}
              </p>
              <p className="text-gray-700 leading-relaxed">{question.explanation}</p>
            </div>
          )}

          <div className="flex justify-between items-center pt-4 border-t">
            {!showExplanation ? (
              <Button
                onClick={handleSubmitAnswer}
                disabled={selectedAnswer === null}
                size="lg"
                className="bg-gradient-to-r from-purple-600 to-pink-600 hover:from-purple-700 hover:to-pink-700"
              >
                Submit Answer
              </Button>
            ) : (
              <Button 
                onClick={handleNextQuestion} 
                size="lg"
                className="bg-gradient-to-r from-purple-600 to-pink-600 hover:from-purple-700 hover:to-pink-700"
              >
                {isLastQuestion ? 'Finish Quiz' : 'Next Question'}
                <ChevronRight className="ml-2 h-5 w-5" />
              </Button>
            )}
          </div>
        </div>
      </CardContent>
    </Card>
  )
}
