import { ReactNode, useState } from "react";
import { Link, useLocation } from "react-router-dom";
import { Menu, X, LogOut, Settings } from "lucide-react";
import { Button } from "@/components/ui/button";

interface LayoutProps {
  children: ReactNode;
  userRole?: "admin" | "staff" | "guest";
  onLogout?: () => void;
}

export default function Layout({ 
  children, 
  userRole = "guest", 
  onLogout 
}: LayoutProps) {
  const location = useLocation();
  const [sidebarOpen, setSidebarOpen] = useState(false);

  const isActive = (path: string) => location.pathname === path;

  const renderNavigation = () => {
    switch (userRole) {
      case "admin":
        return (
          <>
            <NavLink 
              to="/admin/dashboard" 
              label="Dashboard" 
              isActive={isActive("/admin/dashboard")}
            />
            <NavLink 
              to="/admin/menu" 
              label="Menu Management" 
              isActive={isActive("/admin/menu")}
            />
            <NavLink 
              to="/admin/billing" 
              label="Billing" 
              isActive={isActive("/admin/billing")}
            />
            <NavLink 
              to="/admin/records" 
              label="Records & Reports" 
              isActive={isActive("/admin/records")}
            />
            <NavLink 
              to="/admin/inventory" 
              label="Inventory" 
              isActive={isActive("/admin/inventory")}
            />
            <NavLink 
              to="/admin/analytics" 
              label="Analytics" 
              isActive={isActive("/admin/analytics")}
            />
          </>
        );
      case "staff":
        return (
          <>
            <NavLink 
              to="/staff/dashboard" 
              label="Dashboard" 
              isActive={isActive("/staff/dashboard")}
            />
            <NavLink 
              to="/staff/menu" 
              label="Menu" 
              isActive={isActive("/staff/menu")}
            />
            <NavLink 
              to="/staff/billing" 
              label="Billing" 
              isActive={isActive("/staff/billing")}
            />
            <NavLink 
              to="/staff/orders" 
              label="Orders" 
              isActive={isActive("/staff/orders")}
            />
          </>
        );
      default:
        return (
          <>
            <NavLink 
              to="/" 
              label="Home" 
              isActive={isActive("/")}
            />
            <NavLink 
              to="/login" 
              label="Login" 
              isActive={isActive("/login")}
            />
          </>
        );
    }
  };

  return (
    <div className="min-h-screen bg-background">
      {/* Header */}
      <header className="sticky top-0 z-40 border-b border-border bg-card">
        <div className="flex items-center justify-between h-16 px-4 md:px-6">
          {/* Logo */}
          <Link to="/" className="flex items-center gap-2 font-bold text-lg">
            <div className="w-8 h-8 bg-primary rounded-lg flex items-center justify-center text-primary-foreground text-xl">
              🍽️
            </div>
            <span className="hidden sm:inline text-foreground">
              CanteenPro
            </span>
          </Link>

          {/* Desktop Navigation */}
          <nav className="hidden md:flex items-center gap-1">
            {renderNavigation()}
          </nav>

          {/* User Menu & Mobile Toggle */}
          <div className="flex items-center gap-4">
            {userRole !== "guest" && (
              <div className="flex items-center gap-2">
                <span className="text-sm font-medium text-muted-foreground hidden sm:inline">
                  {userRole === "admin" ? "Admin" : "Staff"}
                </span>
                <Button
                  variant="ghost"
                  size="icon"
                  onClick={onLogout}
                  title="Logout"
                >
                  <LogOut className="w-4 h-4" />
                </Button>
              </div>
            )}
            
            {/* Mobile Menu Toggle */}
            <button
              className="md:hidden p-2 hover:bg-secondary rounded-lg transition"
              onClick={() => setSidebarOpen(!sidebarOpen)}
            >
              {sidebarOpen ? (
                <X className="w-5 h-5" />
              ) : (
                <Menu className="w-5 h-5" />
              )}
            </button>
          </div>
        </div>

        {/* Mobile Navigation */}
        {sidebarOpen && (
          <nav className="md:hidden border-t border-border bg-card px-4 py-3 space-y-2">
            {renderNavigation()}
          </nav>
        )}
      </header>

      {/* Main Content */}
      <main className="flex-1">
        {children}
      </main>

      {/* Footer */}
      <footer className="border-t border-border bg-card mt-12">
        <div className="max-w-7xl mx-auto px-4 md:px-6 py-8">
          <div className="grid grid-cols-1 md:grid-cols-3 gap-8 mb-8">
            <div>
              <h3 className="font-bold text-foreground mb-4">CanteenPro</h3>
              <p className="text-sm text-muted-foreground">
                Professional canteen management system for efficient operations
              </p>
            </div>
            <div>
              <h4 className="font-semibold text-foreground mb-4">Features</h4>
              <ul className="space-y-2 text-sm text-muted-foreground">
                <li><a href="#" className="hover:text-primary">Digital Menu</a></li>
                <li><a href="#" className="hover:text-primary">Smart Billing</a></li>
                <li><a href="#" className="hover:text-primary">Analytics</a></li>
                <li><a href="#" className="hover:text-primary">Inventory</a></li>
              </ul>
            </div>
            <div>
              <h4 className="font-semibold text-foreground mb-4">Support</h4>
              <ul className="space-y-2 text-sm text-muted-foreground">
                <li><a href="#" className="hover:text-primary">Documentation</a></li>
                <li><a href="#" className="hover:text-primary">Contact Us</a></li>
                <li><a href="#" className="hover:text-primary">Privacy Policy</a></li>
                <li><a href="#" className="hover:text-primary">Terms of Service</a></li>
              </ul>
            </div>
          </div>
          <div className="border-t border-border pt-8 text-center text-sm text-muted-foreground">
            <p>&copy; 2024 CanteenPro. All rights reserved.</p>
          </div>
        </div>
      </footer>
    </div>
  );
}

interface NavLinkProps {
  to: string;
  label: string;
  isActive: boolean;
}

function NavLink({ to, label, isActive }: NavLinkProps) {
  return (
    <Link
      to={to}
      className={`px-3 py-2 rounded-md text-sm font-medium transition ${
        isActive
          ? "bg-primary text-primary-foreground"
          : "text-foreground hover:bg-secondary"
      }`}
    >
      {label}
    </Link>
  );
}
