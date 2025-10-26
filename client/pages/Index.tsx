import { Link } from "react-router-dom";
import { Button } from "@/components/ui/button";
import Layout from "@/components/Layout";
import {
  UtensilsCrossed,
  BarChart3,
  ShoppingCart,
  Users,
  Clock,
  FileText,
  Zap,
  Lock,
} from "lucide-react";

export default function Index() {
  const features = [
    {
      icon: UtensilsCrossed,
      title: "Digital Menu Display",
      description:
        "Interactive digital menu with item names, prices, and images. Easily categorize food items and manage daily specials.",
    },
    {
      icon: ShoppingCart,
      title: "Smart Billing System",
      description:
        "Automatic calculation of totals, taxes, and discounts. Generate receipts and track orders in real-time.",
    },
    {
      icon: FileText,
      title: "Record Management",
      description:
        "Maintain detailed transaction records. Export data to Excel or PDF for accounting and audits.",
    },
    {
      icon: BarChart3,
      title: "Analytics & Reports",
      description:
        "Real-time sales analytics with graphical reports. Identify best-sellers and peak hours easily.",
    },
    {
      icon: Users,
      title: "User Roles & Access",
      description:
        "Separate Admin and Staff dashboards with different access levels and secure authentication.",
    },
    {
      icon: Zap,
      title: "Inventory Management",
      description:
        "Track stock levels, get low-stock alerts, and generate consumption reports.",
    },
  ];

  return (
    <Layout>
      {/* Hero Section */}
      <section className="relative bg-gradient-to-br from-primary-50 to-blue-50 dark:from-primary-900 dark:to-blue-900 py-16 md:py-24">
        <div className="max-w-7xl mx-auto px-4 md:px-6">
          <div className="text-center max-w-3xl mx-auto">
            <div className="inline-block mb-4 px-4 py-2 bg-primary/10 rounded-full">
              <p className="text-sm font-semibold text-primary">
                🚀 The Future of Canteen Management
              </p>
            </div>
            <h1 className="text-4xl md:text-5xl lg:text-6xl font-bold text-foreground mb-6 leading-tight">
              Streamline Your Canteen Operations
            </h1>
            <p className="text-lg md:text-xl text-muted-foreground mb-8 leading-relaxed">
              CanteenPro is a comprehensive, user-friendly canteen management system
              designed to simplify billing, record management, and digital menu
              operations. Transform your canteen with modern technology.
            </p>
            <div className="flex flex-col sm:flex-row gap-4 justify-center">
              <Link to="/login">
                <Button size="lg" className="w-full sm:w-auto">
                  Get Started
                </Button>
              </Link>
              <Link to="#features">
                <Button size="lg" variant="outline" className="w-full sm:w-auto">
                  Learn More
                </Button>
              </Link>
            </div>
          </div>
        </div>
      </section>

      {/* Features Grid */}
      <section id="features" className="py-16 md:py-24">
        <div className="max-w-7xl mx-auto px-4 md:px-6">
          <div className="text-center mb-16">
            <h2 className="text-3xl md:text-4xl font-bold text-foreground mb-4">
              Powerful Features Built for You
            </h2>
            <p className="text-lg text-muted-foreground max-w-2xl mx-auto">
              Everything you need to manage your canteen efficiently and effectively
            </p>
          </div>

          <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            {features.map((feature, index) => {
              const Icon = feature.icon;
              return (
                <div
                  key={index}
                  className="p-6 rounded-lg border border-border bg-card hover:shadow-lg transition-shadow"
                >
                  <div className="w-12 h-12 bg-primary/10 rounded-lg flex items-center justify-center mb-4">
                    <Icon className="w-6 h-6 text-primary" />
                  </div>
                  <h3 className="text-xl font-semibold text-foreground mb-2">
                    {feature.title}
                  </h3>
                  <p className="text-muted-foreground">
                    {feature.description}
                  </p>
                </div>
              );
            })}
          </div>
        </div>
      </section>

      {/* User Roles Section */}
      <section className="py-16 md:py-24 bg-secondary/30">
        <div className="max-w-7xl mx-auto px-4 md:px-6">
          <div className="text-center mb-16">
            <h2 className="text-3xl md:text-4xl font-bold text-foreground mb-4">
              Designed for Different User Roles
            </h2>
            <p className="text-lg text-muted-foreground max-w-2xl mx-auto">
              Tailored dashboards and access controls for administrators and staff
            </p>
          </div>

          <div className="grid grid-cols-1 md:grid-cols-2 gap-8">
            {/* Admin Dashboard */}
            <div className="p-8 rounded-lg bg-card border border-border">
              <div className="w-16 h-16 bg-primary/10 rounded-lg flex items-center justify-center mb-4">
                <Users className="w-8 h-8 text-primary" />
              </div>
              <h3 className="text-2xl font-bold text-foreground mb-4">
                Admin Dashboard
              </h3>
              <ul className="space-y-3 text-muted-foreground mb-6">
                <li className="flex items-start gap-3">
                  <span className="text-primary font-bold mt-0.5">✓</span>
                  <span>Manage menu items, prices, and categories</span>
                </li>
                <li className="flex items-start gap-3">
                  <span className="text-primary font-bold mt-0.5">✓</span>
                  <span>Monitor inventory and stock levels</span>
                </li>
                <li className="flex items-start gap-3">
                  <span className="text-primary font-bold mt-0.5">✓</span>
                  <span>View comprehensive analytics and reports</span>
                </li>
                <li className="flex items-start gap-3">
                  <span className="text-primary font-bold mt-0.5">✓</span>
                  <span>Manage staff accounts and access levels</span>
                </li>
              </ul>
              <Link to="/login">
                <Button className="w-full">Admin Login</Button>
              </Link>
            </div>

            {/* Staff Dashboard */}
            <div className="p-8 rounded-lg bg-card border border-border">
              <div className="w-16 h-16 bg-accent/10 rounded-lg flex items-center justify-center mb-4">
                <ShoppingCart className="w-8 h-8 text-accent" />
              </div>
              <h3 className="text-2xl font-bold text-foreground mb-4">
                Staff Dashboard
              </h3>
              <ul className="space-y-3 text-muted-foreground mb-6">
                <li className="flex items-start gap-3">
                  <span className="text-accent font-bold mt-0.5">✓</span>
                  <span>Process orders with quick billing interface</span>
                </li>
                <li className="flex items-start gap-3">
                  <span className="text-accent font-bold mt-0.5">✓</span>
                  <span>View digital menu and manage orders</span>
                </li>
                <li className="flex items-start gap-3">
                  <span className="text-accent font-bold mt-0.5">✓</span>
                  <span>Generate and print receipts instantly</span>
                </li>
                <li className="flex items-start gap-3">
                  <span className="text-accent font-bold mt-0.5">✓</span>
                  <span>Track daily sales and order statistics</span>
                </li>
              </ul>
              <Link to="/login">
                <Button variant="outline" className="w-full">
                  Staff Login
                </Button>
              </Link>
            </div>
          </div>
        </div>
      </section>

      {/* Key Benefits */}
      <section className="py-16 md:py-24">
        <div className="max-w-7xl mx-auto px-4 md:px-6">
          <div className="text-center mb-16">
            <h2 className="text-3xl md:text-4xl font-bold text-foreground mb-4">
              Why Choose CanteenPro?
            </h2>
          </div>

          <div className="grid grid-cols-1 md:grid-cols-2 gap-8">
            <div className="flex gap-4">
              <div className="flex-shrink-0">
                <div className="flex items-center justify-center h-12 w-12 rounded-md bg-primary text-primary-foreground">
                  <Zap className="h-6 w-6" />
                </div>
              </div>
              <div>
                <h3 className="text-lg font-medium text-foreground">
                  Increased Efficiency
                </h3>
                <p className="mt-2 text-muted-foreground">
                  Reduce manual work and speed up billing processes with automated
                  calculations and real-time order tracking.
                </p>
              </div>
            </div>

            <div className="flex gap-4">
              <div className="flex-shrink-0">
                <div className="flex items-center justify-center h-12 w-12 rounded-md bg-primary text-primary-foreground">
                  <Lock className="h-6 w-6" />
                </div>
              </div>
              <div>
                <h3 className="text-lg font-medium text-foreground">
                  Secure & Reliable
                </h3>
                <p className="mt-2 text-muted-foreground">
                  Secure login systems and encrypted data storage ensure your
                  information is always protected.
                </p>
              </div>
            </div>

            <div className="flex gap-4">
              <div className="flex-shrink-0">
                <div className="flex items-center justify-center h-12 w-12 rounded-md bg-primary text-primary-foreground">
                  <Clock className="h-6 w-6" />
                </div>
              </div>
              <div>
                <h3 className="text-lg font-medium text-foreground">
                  Real-Time Insights
                </h3>
                <p className="mt-2 text-muted-foreground">
                  Access real-time sales data and analytics to make informed
                  business decisions.
                </p>
              </div>
            </div>

            <div className="flex gap-4">
              <div className="flex-shrink-0">
                <div className="flex items-center justify-center h-12 w-12 rounded-md bg-primary text-primary-foreground">
                  <BarChart3 className="h-6 w-6" />
                </div>
              </div>
              <div>
                <h3 className="text-lg font-medium text-foreground">
                  Easy Reporting
                </h3>
                <p className="mt-2 text-muted-foreground">
                  Export transaction records and reports to Excel or PDF for
                  auditing and accounting purposes.
                </p>
              </div>
            </div>
          </div>
        </div>
      </section>

      {/* CTA Section */}
      <section className="py-16 md:py-24 bg-primary text-primary-foreground">
        <div className="max-w-3xl mx-auto px-4 md:px-6 text-center">
          <h2 className="text-3xl md:text-4xl font-bold mb-4">
            Ready to Transform Your Canteen?
          </h2>
          <p className="text-lg mb-8 opacity-90">
            Join canteens around the world that are using CanteenPro to streamline
            their operations and improve customer satisfaction.
          </p>
          <Link to="/login">
            <Button
              size="lg"
              variant="secondary"
              className="w-full sm:w-auto"
            >
              Get Started Now
            </Button>
          </Link>
        </div>
      </section>
    </Layout>
  );
}
