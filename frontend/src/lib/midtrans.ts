declare global {
  interface Window {
    snap: {
      pay: (
        token: string,
        options: {
          onSuccess?: (result: Record<string, unknown>) => void
          onPending?: (result: Record<string, unknown>) => void
          onError?: (result: Record<string, unknown>) => void
          onClose?: () => void
        }
      ) => void
    }
  }
}

let scriptLoaded = false

export function loadMidtransScript(): Promise<void> {
  if (scriptLoaded && window.snap) {
    return Promise.resolve()
  }

  return new Promise((resolve, reject) => {
    const existingScript = document.getElementById('midtrans-snap')
    if (existingScript) {
      scriptLoaded = true
      resolve()
      return
    }

    const script = document.createElement('script')
    script.id = 'midtrans-snap'
    script.src = 'https://app.sandbox.midtrans.com/snap/snap.js'
    script.setAttribute('data-client-key', import.meta.env.VITE_MIDTRANS_CLIENT_KEY)
    script.onload = () => {
      scriptLoaded = true
      resolve()
    }
    script.onerror = () => reject(new Error('Failed to load Midtrans Snap script'))
    document.head.appendChild(script)
  })
}

interface SnapPayResult {
  status: 'success' | 'pending' | 'error' | 'close'
  result?: Record<string, unknown>
}

export function snapPay(token: string): Promise<SnapPayResult> {
  return new Promise((resolve) => {
    window.snap.pay(token, {
      onSuccess: (result) => resolve({ status: 'success', result }),
      onPending: (result) => resolve({ status: 'pending', result }),
      onError: (result) => resolve({ status: 'error', result }),
      onClose: () => resolve({ status: 'close' }),
    })
  })
}
