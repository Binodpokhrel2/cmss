import { AlertCircle, Plus, Edit, Search } from "lucide-react";
import { Button } from "@/components/ui/button";
import { Input } from "@/components/ui/input";
import Layout from "@/components/Layout";

interface AdminInventoryProps {
  userRole: "admin" | "staff" | "guest";
  onLogout: () => void;
}

export default function AdminInventory({
  userRole,
  onLogout,
}: AdminInventoryProps) {
  const inventory = [
    {
      id: 1,
      name: "Chicken Breast",
      quantity: 45,
      unit: "kg",
      reorderLevel: 20,
      status: "In Stock",
    },
    {
      id: 2,
      name: "Tomato Sauce",
      quantity: 8,
      unit: "liters",
      reorderLevel: 10,
      status: "Low Stock",
    },
    {
      id: 3,
      name: "Paneer",
      quantity: 12,
      unit: "kg",
      reorderLevel: 5,
      status: "In Stock",
    },
    {
      id: 4,
      name: "Cooking Oil",
      quantity: 3,
      unit: "liters",
      reorderLevel: 5,
      status: "Critical",
    },
    {
      id: 5,
      name: "Rice",
      quantity: 120,
      unit: "kg",
      reorderLevel: 50,
      status: "In Stock",
    },
    {
      id: 6,
      name: "Spice Mix",
      quantity: 2,
      unit: "kg",
      reorderLevel: 5,
      status: "Critical",
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
                Inventory Management
              </h1>
              <p className="text-muted-foreground">
                Track stock levels and manage reorders
              </p>
            </div>
            <Button className="w-full md:w-auto">
              <Plus className="w-4 h-4 mr-2" />
              Add Inventory Item
            </Button>
          </div>

          {/* Alert Box */}
          <div className="mb-6 p-4 rounded-lg bg-destructive/10 border border-destructive/20 flex items-start gap-3">
            <AlertCircle className="w-5 h-5 text-destructive flex-shrink-0 mt-0.5" />
            <div>
              <p className="font-semibold text-destructive">Low Stock Alert</p>
              <p className="text-sm text-destructive/80">
                2 items are at critical stock levels. Please place reorders immediately.
              </p>
            </div>
          </div>

          {/* Inventory Stats */}
          <div className="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
            {[
              { label: "Total Items", value: "32", color: "bg-primary/10" },
              { label: "In Stock", value: "28", color: "bg-success/10" },
              { label: "Low Stock", value: "2", color: "bg-warning/10" },
              { label: "Critical", value: "2", color: "bg-destructive/10" },
            ].map((stat, i) => (
              <div
                key={i}
                className={`p-4 rounded-lg border border-border ${stat.color}`}
              >
                <p className="text-sm text-muted-foreground">{stat.label}</p>
                <p className="text-2xl font-bold text-foreground mt-1">
                  {stat.value}
                </p>
              </div>
            ))}
          </div>

          {/* Search */}
          <div className="flex flex-col md:flex-row gap-4 mb-6">
            <div className="flex-1 relative">
              <Search className="absolute left-3 top-3 w-4 h-4 text-muted-foreground" />
              <Input
                placeholder="Search inventory..."
                className="pl-10"
              />
            </div>
            <select className="px-4 py-2 rounded-lg border border-border bg-card text-foreground">
              <option>All Items</option>
              <option>In Stock</option>
              <option>Low Stock</option>
              <option>Critical</option>
            </select>
          </div>

          {/* Inventory Table */}
          <div className="rounded-lg border border-border bg-card overflow-hidden">
            <div className="overflow-x-auto">
              <table className="w-full">
                <thead className="border-b border-border bg-secondary/30">
                  <tr>
                    <th className="px-6 py-3 text-left text-sm font-semibold text-foreground">
                      Item Name
                    </th>
                    <th className="px-6 py-3 text-left text-sm font-semibold text-foreground">
                      Current Stock
                    </th>
                    <th className="px-6 py-3 text-left text-sm font-semibold text-foreground">
                      Reorder Level
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
                  {inventory.map((item) => (
                    <tr key={item.id} className="hover:bg-secondary/30 transition">
                      <td className="px-6 py-4 font-medium text-foreground">
                        {item.name}
                      </td>
                      <td className="px-6 py-4 text-foreground">
                        {item.quantity} {item.unit}
                      </td>
                      <td className="px-6 py-4 text-muted-foreground">
                        {item.reorderLevel} {item.unit}
                      </td>
                      <td className="px-6 py-4">
                        <span
                          className={`px-3 py-1 rounded-full text-sm font-medium ${
                            item.status === "In Stock"
                              ? "bg-success/10 text-success"
                              : item.status === "Low Stock"
                                ? "bg-warning/10 text-warning"
                                : "bg-destructive/10 text-destructive"
                          }`}
                        >
                          {item.status}
                        </span>
                      </td>
                      <td className="px-6 py-4">
                        <button className="p-2 hover:bg-secondary rounded-lg transition text-primary">
                          <Edit className="w-4 h-4" />
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
