import { useState } from "react";
import { useNavigate } from "react-router-dom";
import { Button } from "@/components/ui/button";
import { Input } from "@/components/ui/input";
import { AlertCircle } from "lucide-react";

interface LoginProps {
  onLogin: (role: "admin" | "staff") => void;
}

export default function Login({ onLogin }: LoginProps) {
  const navigate = useNavigate();
  const [role, setRole] = useState<"admin" | "staff" | null>(null);
  const [email, setEmail] = useState("");
  const [password, setPassword] = useState("");
  const [error, setError] = useState("");

  const handleLogin = (e: React.FormEvent) => {
    e.preventDefault();
    setError("");

    if (!role) {
      setError("Please select a role");
      return;
    }

    if (!email || !password) {
      setError("Please enter email and password");
      return;
    }

    // Demo login - accept any credentials
    onLogin(role);
    navigate(role === "admin" ? "/admin/dashboard" : "/staff/dashboard");
  };

  return (
    <div className="min-h-screen bg-gradient-to-br from-primary-50 to-blue-50 dark:from-primary-900 dark:to-blue-900 flex items-center justify-center px-4">
      <div className="max-w-md w-full">
        {/* Logo */}
        <div className="text-center mb-8">
          <div className="w-16 h-16 bg-primary rounded-lg flex items-center justify-center text-4xl mx-auto mb-4">
            🍽️
          </div>
          <h1 className="text-3xl font-bold text-foreground">CanteenPro</h1>
          <p className="text-muted-foreground mt-2">Canteen Management System</p>
        </div>

        {/* Login Card */}
        <div className="bg-card rounded-lg border border-border shadow-lg p-8">
          <form onSubmit={handleLogin} className="space-y-6">
            {/* Error Message */}
            {error && (
              <div className="flex items-center gap-3 p-3 rounded-lg bg-destructive/10 text-destructive">
                <AlertCircle className="w-5 h-5" />
                <p className="text-sm">{error}</p>
              </div>
            )}

            {/* Role Selection */}
            <div>
              <label className="block text-sm font-medium text-foreground mb-3">
                Select Your Role
              </label>
              <div className="grid grid-cols-2 gap-3">
                <button
                  type="button"
                  onClick={() => setRole("admin")}
                  className={`p-4 rounded-lg border-2 transition font-medium ${
                    role === "admin"
                      ? "border-primary bg-primary/10 text-primary"
                      : "border-border bg-card hover:border-primary/30"
                  }`}
                >
                  👨‍💼 Admin
                </button>
                <button
                  type="button"
                  onClick={() => setRole("staff")}
                  className={`p-4 rounded-lg border-2 transition font-medium ${
                    role === "staff"
                      ? "border-primary bg-primary/10 text-primary"
                      : "border-border bg-card hover:border-primary/30"
                  }`}
                >
                  👤 Staff
                </button>
              </div>
            </div>

            {/* Email Input */}
            <div>
              <label className="block text-sm font-medium text-foreground mb-2">
                Email Address
              </label>
              <Input
                type="email"
                placeholder="your@email.com"
                value={email}
                onChange={(e) => setEmail(e.target.value)}
                className="w-full"
              />
            </div>

            {/* Password Input */}
            <div>
              <label className="block text-sm font-medium text-foreground mb-2">
                Password
              </label>
              <Input
                type="password"
                placeholder="••••••••"
                value={password}
                onChange={(e) => setPassword(e.target.value)}
                className="w-full"
              />
            </div>

            {/* Login Button */}
            <Button type="submit" className="w-full" size="lg">
              Sign In
            </Button>

            {/* Demo Info */}
            <div className="p-3 rounded-lg bg-secondary/50 text-center">
              <p className="text-sm text-muted-foreground">
                📝 Demo Mode: Use any email and password
              </p>
            </div>
          </form>

          {/* Footer Links */}
          <div className="mt-6 pt-6 border-t border-border text-center space-y-2">
            <p className="text-sm text-muted-foreground">
              First time here? Start from the{" "}
              <a href="/" className="text-primary hover:underline font-medium">
                home page
              </a>
            </p>
          </div>
        </div>

        {/* Demo Accounts Info */}
        <div className="mt-8 p-4 rounded-lg bg-card border border-border">
          <h3 className="font-semibold text-foreground mb-3">Demo Accounts</h3>
          <div className="space-y-2 text-sm text-muted-foreground">
            <p>
              <strong>Admin:</strong> admin@canteen.com / password
            </p>
            <p>
              <strong>Staff:</strong> staff@canteen.com / password
            </p>
          </div>
        </div>
      </div>
    </div>
  );
}
