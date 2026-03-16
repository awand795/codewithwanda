import { useState } from 'react'
import { Card, CardContent, CardDescription, CardHeader, CardTitle } from '@/components/ui/card'
import { Button } from '@/components/ui/button'
import { Badge } from '@/components/ui/badge'
import { Progress } from '@/components/ui/progress'
import { Trophy, Download, Award, CheckCircle, Lock, ExternalLink, Certificate } from 'lucide-react'
import type { Certificate, CertificateEligibility } from '@/types'

interface CertificateDisplayProps {
  courseId: number
  certificate?: Certificate
  eligibility?: CertificateEligibility
  hasCertificate: boolean
  onClaim: () => void
  onDownload: () => void
  isClaiming: boolean
}

export function CertificateDisplay({
  courseId,
  certificate,
  eligibility,
  hasCertificate,
  onClaim,
  onDownload,
  isClaiming,
}: CertificateDisplayProps) {
  const [showCertificate, setShowCertificate] = useState(false)

  if (!eligibility && !hasCertificate) {
    return null
  }

  const canClaim = eligibility?.can_claim

  return (
    <>
      <Card className="border-0 shadow-xl bg-gradient-to-br from-amber-50 via-yellow-50 to-orange-50">
        <CardHeader>
          <div className="flex items-center justify-between">
            <div className="flex items-center gap-3">
              <div className="p-3 bg-gradient-to-br from-amber-400 to-orange-500 rounded-xl shadow-lg">
                <Award className="h-8 w-8 text-white" />
              </div>
              <div>
                <CardTitle className="text-2xl">Sertifikat Penyelesaian</CardTitle>
                <CardDescription>
                  {hasCertificate 
                    ? 'Selamat! Anda telah menyelesaikan kursus ini' 
                    : 'Selesaikan semua requirement untuk mendapatkan sertifikat'}
                </CardDescription>
              </div>
            </div>
            {hasCertificate && (
              <Badge className="bg-gradient-to-r from-green-500 to-emerald-500 text-white px-4 py-2">
                <CheckCircle className="h-4 w-4 mr-2" />
                Obtained
              </Badge>
            )}
          </div>
        </CardHeader>
        <CardContent className="space-y-6">
          {/* Progress Section */}
          <div className="space-y-3">
            <div className="flex items-center justify-between">
              <span className="text-sm font-medium text-gray-700">Progress Kursus</span>
              <span className="text-sm font-bold text-primary">
                {eligibility?.progress.completed || 0} / {eligibility?.progress.total || 0} lessons
              </span>
            </div>
            <Progress 
              value={eligibility?.progress.percentage || 0} 
              className="h-3"
            />
          </div>

          {/* Quiz Score Section */}
          <div className="flex items-center justify-between p-4 bg-white rounded-lg shadow-sm">
            <div className="flex items-center gap-3">
              <Trophy className={`h-6 w-6 ${
                (eligibility?.quiz_score || 0) >= 70 
                  ? 'text-yellow-500' 
                  : 'text-gray-400'
              }`} />
              <div>
                <div className="font-semibold text-gray-900">Nilai Kuis</div>
                <div className="text-sm text-gray-600">Minimal 70%</div>
              </div>
            </div>
            <div className={`text-2xl font-bold ${
              (eligibility?.quiz_score || 0) >= 70 
                ? 'text-green-600' 
                : 'text-red-500'
            }`}>
              {eligibility?.quiz_score || 0}%
            </div>
          </div>

          {/* Requirements Checklist */}
          <div className="space-y-3 p-4 bg-white rounded-lg shadow-sm">
            <div className="font-semibold text-gray-900 mb-2">Requirement:</div>
            <div className="flex items-center gap-3">
              {eligibility && eligibility.progress.percentage >= 100 ? (
                <CheckCircle className="h-5 w-5 text-green-500" />
              ) : (
                <Lock className="h-5 w-5 text-gray-400" />
              )}
              <span className={eligibility && eligibility.progress.percentage >= 100 ? 'text-green-700' : 'text-gray-600'}>
                Selesaikan semua lesson ({eligibility?.progress.completed || 0}/{eligibility?.progress.total || 0})
              </span>
            </div>
            <div className="flex items-center gap-3">
              {eligibility && eligibility.quiz_score >= 70 ? (
                <CheckCircle className="h-5 w-5 text-green-500" />
              ) : (
                <Lock className="h-5 w-5 text-gray-400" />
              )}
              <span className={eligibility && eligibility.quiz_score >= 70 ? 'text-green-700' : 'text-gray-600'}>
                Nilai kuis rata-rata minimal 70% ({eligibility?.quiz_score || 0}%)
              </span>
            </div>
          </div>

          {/* Action Buttons */}
          <div className="flex gap-3 pt-4">
            {hasCertificate ? (
              <>
                <Button
                  onClick={onDownload}
                  className="flex-1 bg-gradient-to-r from-blue-600 to-cyan-600 hover:from-blue-700 hover:to-cyan-700"
                  size="lg"
                >
                  <Download className="h-5 w-5 mr-2" />
                  Download Certificate
                </Button>
                <Button
                  variant="outline"
                  onClick={() => window.open(certificate?.verification_url, '_blank')}
                  size="lg"
                >
                  <ExternalLink className="h-5 w-5 mr-2" />
                  Verify
                </Button>
              </>
            ) : (
              <Button
                onClick={onClaim}
                disabled={!canClaim || isClaiming}
                className="flex-1 bg-gradient-to-r from-amber-600 to-orange-600 hover:from-amber-700 hover:to-orange-700"
                size="lg"
              >
                {isClaiming ? (
                  'Memproses...'
                ) : canClaim ? (
                  <>
                    <Trophy className="h-5 w-5 mr-2" />
                    Klaim Sertifikat
                  </>
                ) : (
                  <>
                    <Lock className="h-5 w-5 mr-2" />
                    {eligibility?.reason || 'Belum Memenuhi Syarat'}
                  </>
                )}
              </Button>
            )}
          </div>

          {/* Certificate Preview */}
          {hasCertificate && showCertificate && certificate && (
            <div className="mt-6 p-6 bg-white rounded-lg border-2 border-amber-300">
              <div className="text-center space-y-4">
                <Award className="h-16 w-16 text-amber-500 mx-auto" />
                <h3 className="text-2xl font-bold text-gray-900">Certificate of Completion</h3>
                <p className="text-gray-600">This certifies that</p>
                <p className="text-3xl font-bold text-amber-600">{certificate.recipient_name}</p>
                <p className="text-gray-600">has successfully completed the course</p>
                <p className="text-xl font-bold text-gray-900">{certificate.course_title}</p>
                <div className="flex justify-center gap-8 text-sm text-gray-600">
                  <div>
                    <div className="font-bold">{certificate.completion_date}</div>
                    <div>Completion Date</div>
                  </div>
                  <div>
                    <div className="font-bold">{certificate.quiz_score}%</div>
                    <div>Quiz Score</div>
                  </div>
                </div>
                <p className="text-xs text-gray-400 mt-4">
                  Certificate ID: {certificate.certificate_uuid}
                </p>
              </div>
            </div>
          )}
        </CardContent>
      </Card>
    </>
  )
}
