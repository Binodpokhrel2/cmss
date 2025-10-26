import { TrendingUp, BarChart3, PieChart, Clock } from "lucide-react";
import Layout from "@/components/Layout";

interface AdminAnalyticsProps {
  userRole: "admin" | "staff" | "guest";
  onLogout: () => void;
}

export default function AdminAnalytics({
  userRole,
  onLogout,
}: AdminAnalyticsProps) {
  const topItems = [
    { name: "Paneer Butter Masala", sales: 145, revenue: 40600 },
    { name: "Biryani", sales: 128, revenue: 25600 },
    { name: "Chole Bhature", sales: 98, revenue: 14700 },
    { name: "Samosa", sales: 234, revenue: 7020 },
    { name: "Coffee", sales: 156, revenue: 6240 },
  ];

  const peakHours = [
    { hour: "12:00 - 13:00", orders: 245, revenue: 18500 },
    { hour: "13:00 - 14:00", orders: 198, revenue: 15200 },
    { hour: "12:30 - 13:30", orders: 176, revenue: 14300 },
    { hour: "14:00 - 15:00", orders: 145, revenue: 11800 },
  ];

  return (
    <Layout userRole={userRole} onLogout={onLogout}>
      <div className="px-4 md:px-6 py-8">
        <div className="max-w-7xl mx-auto">
          {/* Header */}
          <div className="mb-8">
            <h1 className="text-3xl font-bold text-foreground">
              Analytics & Reports
            </h1>
            <p className="text-muted-foreground">
              Real-time sales insights and performance metrics
            </p>
          </div>

          {/* Key Metrics */}
          <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
            {[
              {
                icon: BarChart3,
                label: "Total Orders",
                value: "4,235",
                change: "+12.5%",
                color: "text-primary",
              },
              {
                icon: TrendingUp,
                label: "Total Revenue",
                value: "₹1,24,890",
                change: "+8.2%",
                color: "text-success",
              },
              {
                icon: PieChart,
                label: "Avg. Order Value",
                value: "₹294.50",
                change: "+3.1%",
                color: "text-accent",
              },
              {
                icon: Clock,
                label: "Peak Hour",
                value: "12:00 - 13:00",
                change: "245 orders",
                color: "text-warning",
              },
            ].map((metric, i) => {
              const Icon = metric.icon;
              return (
                <div
                  key={i}
                  className="p-6 rounded-lg border border-border bg-card"
                >
                  <div className="flex items-start justify-between mb-2">
                    <p className="text-sm text-muted-foreground">
                      {metric.label}
                    </p>
                    <Icon className={`w-5 h-5 ${metric.color}`} />
                  </div>
                  <p className="text-2xl font-bold text-foreground">
                    {metric.value}
                  </p>
                  <p className="text-sm text-success mt-2">{metric.change}</p>
                </div>
              );
            })}
          </div>

          {/* Charts Section */}
          <div className="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
            {/* Top Items */}
            <div className="p-6 rounded-lg border border-border bg-card">
              <h2 className="text-xl font-bold text-foreground mb-4">
                Top Selling Items
              </h2>
              <div className="space-y-4">
                {topItems.map((item, i) => (
                  <div key={i} className="flex items-center justify-between">
                    <div className="flex-1">
                      <p className="font-medium text-foreground">
                        {i + 1}. {item.name}
                      </p>
                      <div className="w-full bg-secondary rounded-full h-2 mt-2">
                        <div
                          className="bg-primary h-2 rounded-full"
                          style={{
                            width: `${(item.sales / 250) * 100}%`,
                          }}
                        ></div>
                      </div>
                    </div>
                    <div className="text-right ml-4">
                      <p className="font-semibold text-foreground">
                        {item.sales} sales
                      </p>
                      <p className="text-sm text-muted-foreground">
                        ₹{item.revenue.toLocaleString()}
                      </p>
                    </div>
                  </div>
                ))}
              </div>
            </div>

            {/* Peak Hours */}
            <div className="p-6 rounded-lg border border-border bg-card">
              <h2 className="text-xl font-bold text-foreground mb-4">
                Peak Hours
              </h2>
              <div className="space-y-4">
                {peakHours.map((hour, i) => (
                  <div key={i} className="flex items-center justify-between">
                    <div className="flex-1">
                      <p className="font-medium text-foreground">{hour.hour}</p>
                      <div className="w-full bg-secondary rounded-full h-2 mt-2">
                        <div
                          className="bg-success h-2 rounded-full"
                          style={{
                            width: `${(hour.orders / 250) * 100}%`,
                          }}
                        ></div>
                      </div>
                    </div>
                    <div className="text-right ml-4">
                      <p className="font-semibold text-foreground">
                        {hour.orders} orders
                      </p>
                      <p className="text-sm text-muted-foreground">
                        ₹{hour.revenue.toLocaleString()}
                      </p>
                    </div>
                  </div>
                ))}
              </div>
            </div>
          </div>

          {/* Daily Trend */}
          <div className="p-6 rounded-lg border border-border bg-card">
            <h2 className="text-xl font-bold text-foreground mb-6">
              7-Day Sales Trend
            </h2>
            <div className="flex items-end justify-between gap-4 h-64">
              {[
                { day: "Mon", value: 450, max: 800 },
                { day: "Tue", value: 520, max: 800 },
                { day: "Wed", value: 480, max: 800 },
                { day: "Thu", value: 650, max: 800 },
                { day: "Fri", value: 720, max: 800 },
                { day: "Sat", value: 890, max: 800 },
                { day: "Sun", value: 650, max: 800 },
              ].map((item) => (
                <div key={item.day} className="flex-1 flex flex-col items-center">
                  <div
                    className="w-full bg-primary rounded-t-lg transition hover:bg-primary/80"
                    style={{
                      height: `${(item.value / item.max) * 100}%`,
                    }}
                  ></div>
                  <p className="text-sm text-muted-foreground mt-2">
                    {item.day}
                  </p>
                  <p className="text-xs text-foreground font-semibold">
                    ₹{(item.value * 100).toLocaleString()}
                  </p>
                </div>
              ))}
            </div>
          </div>
        </div>
      </div>
    </Layout>
  );
}
