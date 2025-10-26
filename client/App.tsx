import "./global.css";

import { Toaster } from "@/components/ui/toaster";
import { createRoot } from "react-dom/client";
import { Toaster as Sonner } from "@/components/ui/sonner";
import { TooltipProvider } from "@/components/ui/tooltip";
import { QueryClient, QueryClientProvider } from "@tanstack/react-query";
import { BrowserRouter, Routes, Route } from "react-router-dom";
import { useState } from "react";

// Pages
import Index from "./pages/Index";
import NotFound from "./pages/NotFound";
import Login from "./pages/Login";
import AdminDashboard from "./pages/Admin/Dashboard";
import AdminMenu from "./pages/Admin/Menu";
import AdminBilling from "./pages/Admin/Billing";
import AdminRecords from "./pages/Admin/Records";
import AdminInventory from "./pages/Admin/Inventory";
import AdminAnalytics from "./pages/Admin/Analytics";
import StaffDashboard from "./pages/Staff/Dashboard";
import StaffMenu from "./pages/Staff/Menu";
import StaffBilling from "./pages/Staff/Billing";
import StaffOrders from "./pages/Staff/Orders";

const queryClient = new QueryClient();

const App = () => {
  const [userRole, setUserRole] = useState<"admin" | "staff" | "guest">("guest");

  const handleLogin = (role: "admin" | "staff") => {
    setUserRole(role);
  };

  const handleLogout = () => {
    setUserRole("guest");
  };

  return (
    <QueryClientProvider client={queryClient}>
      <TooltipProvider>
        <Toaster />
        <Sonner />
        <BrowserRouter>
          <Routes>
            {/* Public Routes */}
            <Route path="/" element={<Index />} />
            <Route
              path="/login"
              element={<Login onLogin={handleLogin} />}
            />

            {/* Admin Routes */}
            <Route
              path="/admin/dashboard"
              element={
                <AdminDashboard
                  userRole={userRole}
                  onLogout={handleLogout}
                />
              }
            />
            <Route
              path="/admin/menu"
              element={
                <AdminMenu
                  userRole={userRole}
                  onLogout={handleLogout}
                />
              }
            />
            <Route
              path="/admin/billing"
              element={
                <AdminBilling
                  userRole={userRole}
                  onLogout={handleLogout}
                />
              }
            />
            <Route
              path="/admin/records"
              element={
                <AdminRecords
                  userRole={userRole}
                  onLogout={handleLogout}
                />
              }
            />
            <Route
              path="/admin/inventory"
              element={
                <AdminInventory
                  userRole={userRole}
                  onLogout={handleLogout}
                />
              }
            />
            <Route
              path="/admin/analytics"
              element={
                <AdminAnalytics
                  userRole={userRole}
                  onLogout={handleLogout}
                />
              }
            />

            {/* Staff Routes */}
            <Route
              path="/staff/dashboard"
              element={
                <StaffDashboard
                  userRole={userRole}
                  onLogout={handleLogout}
                />
              }
            />
            <Route
              path="/staff/menu"
              element={
                <StaffMenu
                  userRole={userRole}
                  onLogout={handleLogout}
                />
              }
            />
            <Route
              path="/staff/billing"
              element={
                <StaffBilling
                  userRole={userRole}
                  onLogout={handleLogout}
                />
              }
            />
            <Route
              path="/staff/orders"
              element={
                <StaffOrders
                  userRole={userRole}
                  onLogout={handleLogout}
                />
              }
            />

            {/* Catch-all 404 route */}
            <Route path="*" element={<NotFound />} />
          </Routes>
        </BrowserRouter>
      </TooltipProvider>
    </QueryClientProvider>
  );
};

createRoot(document.getElementById("root")!).render(<App />);
