import { ShoppingCart, Clock, Banknote, TrendingUp } from "lucide-react";
import { Button } from "@/components/ui/button";
import Layout from "@/components/Layout";
import { Link } from "react-router-dom";

interface StaffDashboardProps {
  userRole: "admin" | "staff" | "guest";
  onLogout: () => void;
}

export default function StaffDashboard({
  userRole,
  onLogout,
}: StaffDashboardProps) {
  return (
    <Layout userRole={userRole} onLogout={onLogout}>
      {/* Header */}
      <div className="px-4 md:px-6 py-8">
        <div className="max-w-7xl mx-auto">
          <h1 className="text-3xl font-bold text-foreground mb-2">
            Welcome, Staff Member
          </h1>
          <p className="text-muted-foreground">
            Process orders and manage billing efficiently
          </p>
        </div>
      </div>

      {/* Quick Stats */}
      <div className="px-4 md:px-6 pb-8">
        <div className="max-w-7xl mx-auto">
          <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            {[
              {
                icon: ShoppingCart,
                label: "Orders Today",
                value: "42",
                color: "bg-primary/10 text-primary",
              },
              {
                icon: Banknote,
                label: "Sales Today",
                value: "₹12,480",
                color: "bg-success/10 text-success",
              },
              {
                icon: Clock,
                label: "Avg. Time",
                value: "2.5 min",
                color: "bg-accent/10 text-accent",
              },
              {
                icon: TrendingUp,
                label: "Efficiency",
                value: "94%",
                color: "bg-warning/10 text-warning",
              },
            ].map((stat, i) => {
              const Icon = stat.icon;
              return (
                <div
                  key={i}
                  className="p-6 rounded-lg bg-card border border-border"
                >
                  <div className="flex items-start justify-between mb-3">
                    <p className="text-sm font-medium text-muted-foreground">
                      {stat.label}
                    </p>
                    <div className={`p-3 rounded-lg ${stat.color}`}>
                      <Icon className="w-5 h-5" />
                    </div>
                  </div>
                  <p className="text-2xl font-bold text-foreground">
                    {stat.value}
                  </p>
                </div>
              );
            })}
          </div>
        </div>
      </div>

      {/* Main Content */}
      <div className="px-4 md:px-6 pb-12">
        <div className="max-w-7xl mx-auto">
          <div className="grid grid-cols-1 lg:grid-cols-3 gap-6">
            {/* Quick Actions */}
            <div className="lg:col-span-1 p-6 rounded-lg bg-card border border-border h-fit">
              <h2 className="text-xl font-bold text-foreground mb-4">
                Quick Actions
              </h2>
              <div className="space-y-3">
                <Link to="/staff/billing" className="block">
                  <Button className="w-full justify-start">
                    <ShoppingCart className="w-4 h-4 mr-2" />
                    New Order
                  </Button>
                </Link>
                <Link to="/staff/menu" className="block">
                  <Button variant="outline" className="w-full justify-start">
                    📋 View Menu
                  </Button>
                </Link>
                <Link to="/staff/orders" className="block">
                  <Button variant="outline" className="w-full justify-start">
                    ✓ Orders
                  </Button>
                </Link>
              </div>
            </div>

            {/* Recent Orders */}
            <div className="lg:col-span-2 p-6 rounded-lg bg-card border border-border">
              <h2 className="text-xl font-bold text-foreground mb-4">
                Recent Orders
              </h2>
              <div className="space-y-4">
                {[
                  { id: "ORD-001", items: 4, amount: "₹420", status: "Completed" },
                  { id: "ORD-002", items: 2, amount: "₹180", status: "Completed" },
                  { id: "ORD-003", items: 5, amount: "₹680", status: "Completed" },
                  { id: "ORD-004", items: 3, amount: "₹350", status: "Pending" },
                ].map((order) => (
                  <div
                    key={order.id}
                    className="flex items-center justify-between p-3 rounded-lg hover:bg-secondary/50 transition border border-border/50"
                  >
                    <div>
                      <p className="font-medium text-foreground">{order.id}</p>
                      <p className="text-sm text-muted-foreground">
                        {order.items} items
                      </p>
                    </div>
                    <div className="text-right">
                      <p className="font-semibold text-foreground">
                        {order.amount}
                      </p>
                      <p
                        className={`text-sm font-medium ${
                          order.status === "Completed"
                            ? "text-success"
                            : "text-warning"
                        }`}
                      >
                        {order.status}
                      </p>
                    </div>
                  </div>
                ))}
              </div>
            </div>
          </div>

          {/* Info Boxes */}
          <div className="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
            <div className="p-6 rounded-lg bg-primary/5 border border-primary/20">
              <h3 className="font-semibold text-foreground mb-2">
                💡 Pro Tip
              </h3>
              <p className="text-sm text-muted-foreground">
                Use keyboard shortcuts to speed up order entry: Press 'B' for
                new bill, 'M' for menu, 'O' for orders.
              </p>
            </div>
            <div className="p-6 rounded-lg bg-accent/5 border border-accent/20">
              <h3 className="font-semibold text-foreground mb-2">
                🔔 Reminder
              </h3>
              <p className="text-sm text-muted-foreground">
                Remember to confirm payment before marking orders as complete.
              </p>
            </div>
          </div>
        </div>
      </div>
    </Layout>
  );
}
