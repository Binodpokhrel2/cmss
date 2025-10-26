import { Plus, Edit, Trash2, Search } from "lucide-react";
import { Button } from "@/components/ui/button";
import { Input } from "@/components/ui/input";
import Layout from "@/components/Layout";

interface AdminMenuProps {
  userRole: "admin" | "staff" | "guest";
  onLogout: () => void;
}

export default function AdminMenu({ userRole, onLogout }: AdminMenuProps) {
  const menuItems = [
    {
      id: 1,
      name: "Paneer Butter Masala",
      category: "Main Course",
      price: 280,
      status: "Active",
    },
    {
      id: 2,
      name: "Biryani",
      category: "Main Course",
      price: 200,
      status: "Active",
    },
    {
      id: 3,
      name: "Samosa",
      category: "Snacks",
      price: 30,
      status: "Active",
    },
    {
      id: 4,
      name: "Coffee",
      category: "Beverages",
      price: 40,
      status: "Active",
    },
    {
      id: 5,
      name: "Fresh Orange Juice",
      category: "Beverages",
      price: 60,
      status: "Active",
    },
    {
      id: 6,
      name: "Chole Bhature",
      category: "Main Course",
      price: 150,
      status: "Limited Stock",
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
                Menu Management
              </h1>
              <p className="text-muted-foreground">
                Add, edit, or remove menu items
              </p>
            </div>
            <Button className="w-full md:w-auto">
              <Plus className="w-4 h-4 mr-2" />
              Add Menu Item
            </Button>
          </div>

          {/* Filters */}
          <div className="flex flex-col md:flex-row gap-4 mb-6">
            <div className="flex-1 relative">
              <Search className="absolute left-3 top-3 w-4 h-4 text-muted-foreground" />
              <Input
                placeholder="Search menu items..."
                className="pl-10"
              />
            </div>
            <select className="px-4 py-2 rounded-lg border border-border bg-card text-foreground">
              <option>All Categories</option>
              <option>Main Course</option>
              <option>Snacks</option>
              <option>Beverages</option>
            </select>
            <select className="px-4 py-2 rounded-lg border border-border bg-card text-foreground">
              <option>All Status</option>
              <option>Active</option>
              <option>Limited Stock</option>
              <option>Inactive</option>
            </select>
          </div>

          {/* Menu Items Table */}
          <div className="rounded-lg border border-border bg-card overflow-hidden">
            <div className="overflow-x-auto">
              <table className="w-full">
                <thead className="border-b border-border bg-secondary/30">
                  <tr>
                    <th className="px-6 py-3 text-left text-sm font-semibold text-foreground">
                      Item Name
                    </th>
                    <th className="px-6 py-3 text-left text-sm font-semibold text-foreground">
                      Category
                    </th>
                    <th className="px-6 py-3 text-left text-sm font-semibold text-foreground">
                      Price
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
                  {menuItems.map((item) => (
                    <tr key={item.id} className="hover:bg-secondary/30 transition">
                      <td className="px-6 py-4 font-medium text-foreground">
                        {item.name}
                      </td>
                      <td className="px-6 py-4 text-muted-foreground">
                        {item.category}
                      </td>
                      <td className="px-6 py-4 font-semibold text-foreground">
                        ₹{item.price}
                      </td>
                      <td className="px-6 py-4">
                        <span
                          className={`px-3 py-1 rounded-full text-sm font-medium ${
                            item.status === "Active"
                              ? "bg-success/10 text-success"
                              : "bg-warning/10 text-warning"
                          }`}
                        >
                          {item.status}
                        </span>
                      </td>
                      <td className="px-6 py-4">
                        <div className="flex items-center gap-2">
                          <button className="p-2 hover:bg-secondary rounded-lg transition text-primary">
                            <Edit className="w-4 h-4" />
                          </button>
                          <button className="p-2 hover:bg-secondary rounded-lg transition text-destructive">
                            <Trash2 className="w-4 h-4" />
                          </button>
                        </div>
                      </td>
                    </tr>
                  ))}
                </tbody>
              </table>
            </div>
          </div>

          {/* Categories Section */}
          <div className="mt-8 grid grid-cols-1 md:grid-cols-4 gap-4">
            {[
              { name: "Main Course", count: 12 },
              { name: "Snacks", count: 18 },
              { name: "Beverages", count: 24 },
              { name: "Desserts", count: 8 },
            ].map((cat) => (
              <div
                key={cat.name}
                className="p-4 rounded-lg border border-border bg-card"
              >
                <h3 className="font-semibold text-foreground">{cat.name}</h3>
                <p className="text-2xl font-bold text-primary mt-2">
                  {cat.count}
                </p>
                <p className="text-sm text-muted-foreground mt-1">items</p>
              </div>
            ))}
          </div>
        </div>
      </div>
    </Layout>
  );
}
