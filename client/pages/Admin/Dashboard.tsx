import { BarChart3, Users, UtensilsCrossed, TrendingUp } from "lucide-react";
import Layout from "@/components/Layout";

interface AdminDashboardProps {
  userRole: "admin" | "staff" | "guest";
  onLogout: () => void;
}

export default function AdminDashboard({
  userRole,
  onLogout,
}: AdminDashboardProps) {
  const stats = [
    {
      title: "Total Orders Today",
      value: "1,234",
      change: "+12.5%",
      icon: BarChart3,
      color: "bg-primary/10 text-primary",
    },
    {
      title: "Revenue",
      value: "₹45,680",
      change: "+8.2%",
      icon: TrendingUp,
      color: "bg-success/10 text-success",
    },
    {
      title: "Active Users",
      value: "284",
      change: "+4.3%",
      icon: Users,
      color: "bg-accent/10 text-accent",
    },
    {
      title: "Menu Items",
      value: "156",
      change: "5 new",
      icon: UtensilsCrossed,
      color: "bg-warning/10 text-warning",
    },
  ];

  return (
    <Layout userRole={userRole} onLogout={onLogout}>
      {/* Header */}
      <div className="px-4 md:px-6 py-8">
        <div className="max-w-7xl mx-auto">
          <h1 className="text-3xl font-bold text-foreground mb-2">
            Welcome back, Admin
          </h1>
          <p className="text-muted-foreground">
            Here's what's happening with your canteen today
          </p>
        </div>
      </div>

      {/* Stats Grid */}
      <div className="px-4 md:px-6 pb-8">
        <div className="max-w-7xl mx-auto">
          <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            {stats.map((stat, index) => {
              const Icon = stat.icon;
              return (
                <div
                  key={index}
                  className="p-6 rounded-lg bg-card border border-border"
                >
                  <div className="flex items-start justify-between mb-4">
                    <div>
                      <p className="text-sm font-medium text-muted-foreground">
                        {stat.title}
                      </p>
                      <p className="text-2xl font-bold text-foreground mt-1">
                        {stat.value}
                      </p>
                    </div>
                    <div className={`p-3 rounded-lg ${stat.color}`}>
                      <Icon className="w-5 h-5" />
                    </div>
                  </div>
                  <p className="text-sm text-success font-medium">
                    {stat.change}
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
            {/* Recent Orders */}
            <div className="lg:col-span-2 p-6 rounded-lg bg-card border border-border">
              <h2 className="text-xl font-bold text-foreground mb-4">
                Recent Orders
              </h2>
              <div className="space-y-4">
                {[
                  {
                    id: "ORD-001",
                    customer: "John Doe",
                    amount: "₹245.00",
                    time: "2 min ago",
                    status: "Completed",
                  },
                  {
                    id: "ORD-002",
                    customer: "Jane Smith",
                    amount: "₹185.50",
                    time: "5 min ago",
                    status: "Completed",
                  },
                  {
                    id: "ORD-003",
                    customer: "Mike Johnson",
                    amount: "₹320.00",
                    time: "8 min ago",
                    status: "Completed",
                  },
                  {
                    id: "ORD-004",
                    customer: "Sarah Wilson",
                    amount: "₹156.75",
                    time: "12 min ago",
                    status: "Completed",
                  },
                ].map((order) => (
                  <div
                    key={order.id}
                    className="flex items-center justify-between p-3 rounded-lg hover:bg-secondary/50 transition"
                  >
                    <div className="flex-1">
                      <p className="font-medium text-foreground">
                        {order.id} - {order.customer}
                      </p>
                      <p className="text-sm text-muted-foreground">
                        {order.time}
                      </p>
                    </div>
                    <div className="text-right">
                      <p className="font-semibold text-foreground">
                        {order.amount}
                      </p>
                      <p className="text-sm text-success">{order.status}</p>
                    </div>
                  </div>
                ))}
              </div>
            </div>

            {/* Quick Actions */}
            <div className="p-6 rounded-lg bg-card border border-border">
              <h2 className="text-xl font-bold text-foreground mb-4">
                Quick Actions
              </h2>
              <div className="space-y-3">
                <a
                  href="/admin/menu"
                  className="block p-3 rounded-lg bg-primary/10 hover:bg-primary/20 transition text-primary font-medium"
                >
                  🍽️ Manage Menu
                </a>
                <a
                  href="/admin/inventory"
                  className="block p-3 rounded-lg bg-accent/10 hover:bg-accent/20 transition text-accent font-medium"
                >
                  📦 Check Inventory
                </a>
                <a
                  href="/admin/analytics"
                  className="block p-3 rounded-lg bg-warning/10 hover:bg-warning/20 transition text-warning font-medium"
                >
                  📊 View Analytics
                </a>
                <a
                  href="/admin/records"
                  className="block p-3 rounded-lg bg-blue-100 hover:bg-blue-200 transition text-blue-700 font-medium"
                >
                  📋 Export Reports
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </Layout>
  );
}
