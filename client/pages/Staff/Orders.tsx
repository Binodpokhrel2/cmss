import { Check, Clock, Eye, Search } from "lucide-react";
import { Input } from "@/components/ui/input";
import Layout from "@/components/Layout";

interface StaffOrdersProps {
  userRole: "admin" | "staff" | "guest";
  onLogout: () => void;
}

export default function StaffOrders({ userRole, onLogout }: StaffOrdersProps) {
  const orders = [
    {
      id: "ORD-001",
      time: "14:32",
      items: ["Paneer Butter Masala", "Biryani"],
      amount: 480,
      status: "Preparing",
    },
    {
      id: "ORD-002",
      time: "14:28",
      items: ["Samosa (2)", "Coffee"],
      amount: 110,
      status: "Ready",
    },
    {
      id: "ORD-003",
      time: "14:15",
      items: ["Chole Bhature", "Lassi"],
      amount: 200,
      status: "Completed",
    },
    {
      id: "ORD-004",
      time: "14:05",
      items: ["Biryani", "Spring Rolls"],
      amount: 280,
      status: "Completed",
    },
    {
      id: "ORD-005",
      time: "13:52",
      items: ["Coffee", "Juice"],
      amount: 100,
      status: "Completed",
    },
  ];

  return (
    <Layout userRole={userRole} onLogout={onLogout}>
      <div className="px-4 md:px-6 py-8">
        <div className="max-w-7xl mx-auto">
          {/* Header */}
          <div className="mb-8">
            <h1 className="text-3xl font-bold text-foreground">
              Orders
            </h1>
            <p className="text-muted-foreground">
              Track and manage customer orders
            </p>
          </div>

          {/* Status Overview */}
          <div className="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
            {[
              { label: "Pending", count: 2, color: "bg-warning/10 text-warning" },
              { label: "Preparing", count: 1, color: "bg-primary/10 text-primary" },
              { label: "Ready", count: 1, color: "bg-accent/10 text-accent" },
              { label: "Total Today", count: 45, color: "bg-secondary/30" },
            ].map((stat, i) => (
              <div
                key={i}
                className={`p-4 rounded-lg border border-border ${
                  i === 3 ? "bg-card" : stat.color
                }`}
              >
                <p className="text-sm text-muted-foreground">{stat.label}</p>
                <p className="text-2xl font-bold mt-1">{stat.count}</p>
              </div>
            ))}
          </div>

          {/* Search */}
          <div className="flex gap-4 mb-6">
            <div className="flex-1 relative">
              <Search className="absolute left-3 top-3 w-4 h-4 text-muted-foreground" />
              <Input
                placeholder="Search order by ID..."
                className="pl-10"
              />
            </div>
            <select className="px-4 py-2 rounded-lg border border-border bg-card text-foreground">
              <option>All Status</option>
              <option>Pending</option>
              <option>Preparing</option>
              <option>Ready</option>
              <option>Completed</option>
            </select>
          </div>

          {/* Orders List */}
          <div className="space-y-3">
            {orders.map((order) => (
              <div
                key={order.id}
                className={`p-6 rounded-lg border-2 transition ${
                  order.status === "Completed"
                    ? "border-border bg-secondary/20"
                    : order.status === "Ready"
                      ? "border-success bg-success/5"
                      : "border-primary bg-primary/5"
                }`}
              >
                <div className="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                  {/* Order Info */}
                  <div className="flex-1">
                    <div className="flex items-center gap-3 mb-2">
                      <h3 className="text-lg font-bold text-foreground">
                        {order.id}
                      </h3>
                      <span
                        className={`px-3 py-1 rounded-full text-xs font-semibold ${
                          order.status === "Completed"
                            ? "bg-success/20 text-success"
                            : order.status === "Ready"
                              ? "bg-accent/20 text-accent"
                              : "bg-primary/20 text-primary"
                        }`}
                      >
                        {order.status}
                      </span>
                    </div>
                    <p className="text-sm text-muted-foreground mb-2">
                      {order.time}
                    </p>
                    <div className="flex flex-wrap gap-2">
                      {order.items.map((item, i) => (
                        <span
                          key={i}
                          className="text-sm px-2 py-1 rounded bg-secondary text-foreground"
                        >
                          {item}
                        </span>
                      ))}
                    </div>
                  </div>

                  {/* Amount & Actions */}
                  <div className="flex items-center justify-between md:justify-end gap-4">
                    <div className="text-right">
                      <p className="text-sm text-muted-foreground">Amount</p>
                      <p className="text-2xl font-bold text-foreground">
                        ₹{order.amount}
                      </p>
                    </div>
                    <div className="flex gap-2">
                      {order.status !== "Completed" && (
                        <>
                          {order.status === "Pending" && (
                            <button className="p-2 rounded-lg bg-primary text-primary-foreground hover:bg-primary/90 transition">
                              <Clock className="w-5 h-5" />
                            </button>
                          )}
                          {order.status === "Preparing" && (
                            <button className="p-2 rounded-lg bg-accent text-accent-foreground hover:bg-accent/90 transition">
                              <Check className="w-5 h-5" />
                            </button>
                          )}
                          {order.status === "Ready" && (
                            <button className="p-2 rounded-lg bg-success text-success-foreground hover:bg-success/90 transition">
                              <Check className="w-5 h-5" />
                            </button>
                          )}
                        </>
                      )}
                      <button className="p-2 rounded-lg border border-border hover:bg-secondary transition">
                        <Eye className="w-5 h-5" />
                      </button>
                    </div>
                  </div>
                </div>
              </div>
            ))}
          </div>
        </div>
      </div>
    </Layout>
  );
}
