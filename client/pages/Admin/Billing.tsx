import { Download, Eye, Search } from "lucide-react";
import { Button } from "@/components/ui/button";
import { Input } from "@/components/ui/input";
import Layout from "@/components/Layout";

interface AdminBillingProps {
  userRole: "admin" | "staff" | "guest";
  onLogout: () => void;
}

export default function AdminBilling({
  userRole,
  onLogout,
}: AdminBillingProps) {
  const bills = [
    {
      id: "BILL-2024-001",
      date: "Mar 15, 2024",
      amount: 2450.50,
      items: 12,
      status: "Paid",
    },
    {
      id: "BILL-2024-002",
      date: "Mar 14, 2024",
      amount: 1880.75,
      items: 9,
      status: "Paid",
    },
    {
      id: "BILL-2024-003",
      date: "Mar 13, 2024",
      amount: 3245.00,
      items: 15,
      status: "Paid",
    },
    {
      id: "BILL-2024-004",
      date: "Mar 12, 2024",
      amount: 1560.25,
      items: 8,
      status: "Pending",
    },
    {
      id: "BILL-2024-005",
      date: "Mar 11, 2024",
      amount: 2890.00,
      items: 13,
      status: "Paid",
    },
  ];

  return (
    <Layout userRole={userRole} onLogout={onLogout}>
      <div className="px-4 md:px-6 py-8">
        <div className="max-w-7xl mx-auto">
          {/* Header */}
          <div className="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-8">
            <div>
              <h1 className="text-3xl font-bold text-foreground">
                Billing Management
              </h1>
              <p className="text-muted-foreground">
                View and manage all bills and transactions
              </p>
            </div>
            <Button variant="outline" className="w-full md:w-auto">
              <Download className="w-4 h-4 mr-2" />
              Export Bills
            </Button>
          </div>

          {/* Billing Stats */}
          <div className="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
            {[
              { label: "Today's Revenue", value: "₹45,680", change: "+12.5%" },
              {
                label: "Weekly Revenue",
                value: "₹2,45,800",
                change: "+8.2%",
              },
              {
                label: "Monthly Revenue",
                value: "₹8,90,450",
                change: "+5.3%",
              },
            ].map((stat, i) => (
              <div key={i} className="p-6 rounded-lg border border-border bg-card">
                <p className="text-sm text-muted-foreground">{stat.label}</p>
                <p className="text-2xl font-bold text-foreground mt-2">
                  {stat.value}
                </p>
                <p className="text-sm text-success mt-2">{stat.change}</p>
              </div>
            ))}
          </div>

          {/* Search and Filter */}
          <div className="flex flex-col md:flex-row gap-4 mb-6">
            <div className="flex-1 relative">
              <Search className="absolute left-3 top-3 w-4 h-4 text-muted-foreground" />
              <Input
                placeholder="Search bills by ID..."
                className="pl-10"
              />
            </div>
            <select className="px-4 py-2 rounded-lg border border-border bg-card text-foreground">
              <option>All Status</option>
              <option>Paid</option>
              <option>Pending</option>
            </select>
          </div>

          {/* Bills Table */}
          <div className="rounded-lg border border-border bg-card overflow-hidden">
            <div className="overflow-x-auto">
              <table className="w-full">
                <thead className="border-b border-border bg-secondary/30">
                  <tr>
                    <th className="px-6 py-3 text-left text-sm font-semibold text-foreground">
                      Bill ID
                    </th>
                    <th className="px-6 py-3 text-left text-sm font-semibold text-foreground">
                      Date
                    </th>
                    <th className="px-6 py-3 text-left text-sm font-semibold text-foreground">
                      Items
                    </th>
                    <th className="px-6 py-3 text-left text-sm font-semibold text-foreground">
                      Amount
                    </th>
                    <th className="px-6 py-3 text-left text-sm font-semibold text-foreground">
                      Status
                    </th>
                    <th className="px-6 py-3 text-left text-sm font-semibold text-foreground">
                      Actions
                    </th>
                  </tr>
                </thead>
                <tbody className="divide-y divide-border">
                  {bills.map((bill) => (
                    <tr key={bill.id} className="hover:bg-secondary/30 transition">
                      <td className="px-6 py-4 font-medium text-foreground">
                        {bill.id}
                      </td>
                      <td className="px-6 py-4 text-muted-foreground">
                        {bill.date}
                      </td>
                      <td className="px-6 py-4 text-foreground">{bill.items}</td>
                      <td className="px-6 py-4 font-semibold text-foreground">
                        ₹{bill.amount.toFixed(2)}
                      </td>
                      <td className="px-6 py-4">
                        <span
                          className={`px-3 py-1 rounded-full text-sm font-medium ${
                            bill.status === "Paid"
                              ? "bg-success/10 text-success"
                              : "bg-warning/10 text-warning"
                          }`}
                        >
                          {bill.status}
                        </span>
                      </td>
                      <td className="px-6 py-4">
                        <button className="p-2 hover:bg-secondary rounded-lg transition text-primary">
                          <Eye className="w-4 h-4" />
                        </button>
                      </td>
                    </tr>
                  ))}
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </Layout>
  );
}
