import { Plus, Trash2, Printer, X } from "lucide-react";
import { Button } from "@/components/ui/button";
import { useState } from "react";
import Layout from "@/components/Layout";

interface StaffBillingProps {
  userRole: "admin" | "staff" | "guest";
  onLogout: () => void;
}

export default function StaffBilling({
  userRole,
  onLogout,
}: StaffBillingProps) {
  const [orderItems, setOrderItems] = useState([
    { id: 1, name: "Paneer Butter Masala", price: 280, qty: 1 },
    { id: 2, name: "Biryani", price: 200, qty: 1 },
  ]);

  const subtotal = orderItems.reduce((sum, item) => sum + item.price * item.qty, 0);
  const tax = subtotal * 0.05;
  const total = subtotal + tax;

  return (
    <Layout userRole={userRole} onLogout={onLogout}>
      <div className="px-4 md:px-6 py-8">
        <div className="max-w-7xl mx-auto">
          {/* Header */}
          <div className="mb-8">
            <h1 className="text-3xl font-bold text-foreground">
              Smart Billing
            </h1>
            <p className="text-muted-foreground">
              Process orders and generate receipts
            </p>
          </div>

          <div className="grid grid-cols-1 lg:grid-cols-3 gap-6">
            {/* Menu Items */}
            <div className="lg:col-span-2">
              <div className="p-6 rounded-lg bg-card border border-border mb-6">
                <h2 className="text-xl font-bold text-foreground mb-4">
                  Quick Add Items
                </h2>
                <div className="grid grid-cols-2 md:grid-cols-3 gap-3">
                  {[
                    { name: "Paneer Masala", price: 280 },
                    { name: "Biryani", price: 200 },
                    { name: "Samosa", price: 30 },
                    { name: "Coffee", price: 40 },
                    { name: "Juice", price: 60 },
                    { name: "Naan", price: 80 },
                  ].map((item, i) => (
                    <button
                      key={i}
                      className="p-3 rounded-lg border border-border hover:bg-primary/10 transition"
                      onClick={() => {
                        const existing = orderItems.find(
                          (o) => o.name === item.name
                        );
                        if (existing) {
                          setOrderItems(
                            orderItems.map((o) =>
                              o.id === existing.id
                                ? { ...o, qty: o.qty + 1 }
                                : o
                            )
                          );
                        } else {
                          setOrderItems([
                            ...orderItems,
                            {
                              id: Math.random(),
                              name: item.name,
                              price: item.price,
                              qty: 1,
                            },
                          ]);
                        }
                      }}
                    >
                      <p className="text-sm font-medium text-foreground">
                        {item.name}
                      </p>
                      <p className="text-xs text-muted-foreground mt-1">
                        ₹{item.price}
                      </p>
                    </button>
                  ))}
                </div>
              </div>

              {/* Special Options */}
              <div className="p-6 rounded-lg bg-card border border-border">
                <h2 className="text-xl font-bold text-foreground mb-4">
                  Order Options
                </h2>
                <div className="space-y-3">
                  <div>
                    <label className="block text-sm font-medium text-foreground mb-2">
                      Customer Name
                    </label>
                    <input
                      type="text"
                      placeholder="Enter customer name (optional)"
                      className="w-full px-4 py-2 rounded-lg border border-border bg-background text-foreground"
                    />
                  </div>
                  <div>
                    <label className="flex items-center gap-2">
                      <input type="checkbox" className="rounded" />
                      <span className="text-sm font-medium text-foreground">
                        Apply Discount
                      </span>
                    </label>
                  </div>
                </div>
              </div>
            </div>

            {/* Bill Summary */}
            <div className="lg:col-span-1 sticky top-20">
              <div className="p-6 rounded-lg border-2 border-primary bg-card">
                <h2 className="text-xl font-bold text-foreground mb-4">
                  Order Summary
                </h2>

                {/* Items List */}
                <div className="space-y-3 mb-6 max-h-64 overflow-y-auto">
                  {orderItems.map((item) => (
                    <div
                      key={item.id}
                      className="flex items-center justify-between p-3 rounded-lg bg-secondary/30"
                    >
                      <div className="flex-1">
                        <p className="text-sm font-medium text-foreground">
                          {item.name}
                        </p>
                        <div className="flex items-center gap-2 mt-1">
                          <button
                            onClick={() => {
                              if (item.qty > 1) {
                                setOrderItems(
                                  orderItems.map((o) =>
                                    o.id === item.id
                                      ? { ...o, qty: o.qty - 1 }
                                      : o
                                  )
                                );
                              }
                            }}
                            className="px-2 py-1 text-xs bg-secondary rounded hover:bg-secondary/80"
                          >
                            −
                          </button>
                          <span className="text-xs font-medium w-6 text-center">
                            {item.qty}
                          </span>
                          <button
                            onClick={() => {
                              setOrderItems(
                                orderItems.map((o) =>
                                  o.id === item.id
                                    ? { ...o, qty: o.qty + 1 }
                                    : o
                                )
                              );
                            }}
                            className="px-2 py-1 text-xs bg-secondary rounded hover:bg-secondary/80"
                          >
                            +
                          </button>
                        </div>
                      </div>
                      <div className="text-right">
                        <p className="text-sm font-semibold text-foreground">
                          ₹{item.price * item.qty}
                        </p>
                        <button
                          onClick={() => {
                            setOrderItems(
                              orderItems.filter((o) => o.id !== item.id)
                            );
                          }}
                          className="text-xs text-destructive hover:underline mt-1"
                        >
                          Remove
                        </button>
                      </div>
                    </div>
                  ))}
                </div>

                {/* Totals */}
                <div className="space-y-2 border-t border-border pt-4 mb-4">
                  <div className="flex justify-between text-sm">
                    <span className="text-muted-foreground">Subtotal</span>
                    <span className="text-foreground font-medium">
                      ₹{subtotal.toFixed(2)}
                    </span>
                  </div>
                  <div className="flex justify-between text-sm">
                    <span className="text-muted-foreground">Tax (5%)</span>
                    <span className="text-foreground font-medium">
                      ₹{tax.toFixed(2)}
                    </span>
                  </div>
                  <div className="flex justify-between text-lg font-bold border-t border-border pt-2 mt-2">
                    <span className="text-foreground">Total</span>
                    <span className="text-primary">₹{total.toFixed(2)}</span>
                  </div>
                </div>

                {/* Action Buttons */}
                <div className="space-y-2">
                  <Button className="w-full">
                    <Printer className="w-4 h-4 mr-2" />
                    Complete Order & Print
                  </Button>
                  <Button
                    variant="outline"
                    className="w-full"
                    onClick={() => setOrderItems([])}
                  >
                    <X className="w-4 h-4 mr-2" />
                    Clear Bill
                  </Button>
                </div>

                {/* Quick Buttons */}
                <div className="mt-4 flex gap-2">
                  <button className="flex-1 px-3 py-2 rounded-lg text-sm bg-secondary hover:bg-secondary/80 font-medium text-foreground">
                    Cash
                  </button>
                  <button className="flex-1 px-3 py-2 rounded-lg text-sm bg-secondary hover:bg-secondary/80 font-medium text-foreground">
                    Card
                  </button>
                  <button className="flex-1 px-3 py-2 rounded-lg text-sm bg-secondary hover:bg-secondary/80 font-medium text-foreground">
                    UPI
                  </button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </Layout>
  );
}
