import { Search } from "lucide-react";
import { Input } from "@/components/ui/input";
import Layout from "@/components/Layout";

interface StaffMenuProps {
  userRole: "admin" | "staff" | "guest";
  onLogout: () => void;
}

export default function StaffMenu({ userRole, onLogout }: StaffMenuProps) {
  const categories = [
    {
      name: "Main Course",
      items: [
        { id: 1, name: "Paneer Butter Masala", price: 280 },
        { id: 2, name: "Biryani", price: 200 },
        { id: 3, name: "Chole Bhature", price: 150 },
      ],
    },
    {
      name: "Snacks",
      items: [
        { id: 4, name: "Samosa", price: 30 },
        { id: 5, name: "Pakora", price: 50 },
        { id: 6, name: "Spring Rolls", price: 80 },
      ],
    },
    {
      name: "Beverages",
      items: [
        { id: 7, name: "Coffee", price: 40 },
        { id: 8, name: "Fresh Orange Juice", price: 60 },
        { id: 9, name: "Lassi", price: 50 },
      ],
    },
  ];

  return (
    <Layout userRole={userRole} onLogout={onLogout}>
      <div className="px-4 md:px-6 py-8">
        <div className="max-w-7xl mx-auto">
          {/* Header */}
          <div className="mb-8">
            <h1 className="text-3xl font-bold text-foreground">Menu</h1>
            <p className="text-muted-foreground">
              Browse available items and add to order
            </p>
          </div>

          {/* Search */}
          <div className="mb-8 relative">
            <Search className="absolute left-3 top-3 w-4 h-4 text-muted-foreground" />
            <Input
              placeholder="Search menu items..."
              className="pl-10"
            />
          </div>

          {/* Categories */}
          <div className="space-y-8">
            {categories.map((category) => (
              <div key={category.name}>
                <h2 className="text-2xl font-bold text-foreground mb-4">
                  {category.name}
                </h2>
                <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                  {category.items.map((item) => (
                    <div
                      key={item.id}
                      className="p-4 rounded-lg border border-border bg-card hover:shadow-lg transition cursor-pointer"
                    >
                      <div className="flex items-start justify-between mb-2">
                        <h3 className="font-semibold text-foreground">
                          {item.name}
                        </h3>
                        <span className="px-2 py-1 rounded bg-primary/10 text-primary text-sm font-medium">
                          ₹{item.price}
                        </span>
                      </div>
                      <button className="w-full mt-3 px-3 py-2 rounded-lg bg-primary text-primary-foreground font-medium hover:bg-primary/90 transition">
                        Add to Order
                      </button>
                    </div>
                  ))}
                </div>
              </div>
            ))}
          </div>

          {/* Today's Special */}
          <div className="mt-8 p-6 rounded-lg border-2 border-accent bg-accent/5">
            <h2 className="text-xl font-bold text-foreground mb-3">
              🌟 Today's Special
            </h2>
            <div className="flex items-center justify-between">
              <div>
                <p className="font-semibold text-foreground text-lg">
                  Butter Garlic Naan
                </p>
                <p className="text-muted-foreground">
                  Freshly made naan with butter and garlic
                </p>
              </div>
              <div className="text-right">
                <p className="text-2xl font-bold text-accent">₹80</p>
                <p className="text-sm text-success font-medium">Available</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </Layout>
  );
}
