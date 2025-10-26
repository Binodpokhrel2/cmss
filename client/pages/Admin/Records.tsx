import { Download, FileText, Calendar } from "lucide-react";
import { Button } from "@/components/ui/button";
import Layout from "@/components/Layout";

interface AdminRecordsProps {
  userRole: "admin" | "staff" | "guest";
  onLogout: () => void;
}

export default function AdminRecords({ userRole, onLogout }: AdminRecordsProps) {
  return (
    <Layout userRole={userRole} onLogout={onLogout}>
      <div className="px-4 md:px-6 py-8">
        <div className="max-w-7xl mx-auto">
          {/* Header */}
          <div className="mb-8">
            <h1 className="text-3xl font-bold text-foreground">
              Records & Reports
            </h1>
            <p className="text-muted-foreground">
              Generate and export transaction records and detailed reports
            </p>
          </div>

          {/* Report Types */}
          <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
            {[
              {
                title: "Daily Report",
                description: "Complete transaction summary for a single day",
                icon: "📅",
              },
              {
                title: "Weekly Report",
                description: "Sales trends and statistics for the week",
                icon: "📊",
              },
              {
                title: "Monthly Report",
                description: "Comprehensive monthly performance analysis",
                icon: "📈",
              },
              {
                title: "Item-wise Report",
                description: "Detailed sales data for each menu item",
                icon: "🍽️",
              },
              {
                title: "Staff Report",
                description: "Staff performance and sales tracking",
                icon: "👥",
              },
              {
                title: "Tax Report",
                description: "Tax summary for accounting and audits",
                icon: "💰",
              },
            ].map((report, i) => (
              <div
                key={i}
                className="p-6 rounded-lg border border-border bg-card hover:shadow-lg transition cursor-pointer"
              >
                <div className="text-4xl mb-3">{report.icon}</div>
                <h3 className="text-lg font-semibold text-foreground mb-2">
                  {report.title}
                </h3>
                <p className="text-sm text-muted-foreground mb-4">
                  {report.description}
                </p>
                <Button variant="outline" size="sm" className="w-full">
                  Generate
                </Button>
              </div>
            ))}
          </div>

          {/* Export Options */}
          <div className="p-6 rounded-lg border border-border bg-card mb-8">
            <h2 className="text-xl font-bold text-foreground mb-4">
              Advanced Export Options
            </h2>
            <div className="grid grid-cols-1 md:grid-cols-2 gap-4">
              <div className="flex items-center gap-4 p-4 rounded-lg bg-secondary/30">
                <FileText className="w-6 h-6 text-primary" />
                <div>
                  <p className="font-medium text-foreground">Export as PDF</p>
                  <p className="text-sm text-muted-foreground">
                    Professional PDF format for printing
                  </p>
                </div>
              </div>
              <div className="flex items-center gap-4 p-4 rounded-lg bg-secondary/30">
                <Download className="w-6 h-6 text-primary" />
                <div>
                  <p className="font-medium text-foreground">Export as Excel</p>
                  <p className="text-sm text-muted-foreground">
                    Editable Excel format for analysis
                  </p>
                </div>
              </div>
            </div>
          </div>

          {/* Date Range Selector */}
          <div className="p-6 rounded-lg border border-border bg-card">
            <h2 className="text-xl font-bold text-foreground mb-4">
              Custom Report Period
            </h2>
            <div className="grid grid-cols-1 md:grid-cols-2 gap-4">
              <div>
                <label className="block text-sm font-medium text-foreground mb-2">
                  From Date
                </label>
                <input
                  type="date"
                  className="w-full px-4 py-2 rounded-lg border border-border bg-background text-foreground"
                />
              </div>
              <div>
                <label className="block text-sm font-medium text-foreground mb-2">
                  To Date
                </label>
                <input
                  type="date"
                  className="w-full px-4 py-2 rounded-lg border border-border bg-background text-foreground"
                />
              </div>
            </div>
            <Button className="w-full mt-4">
              <Calendar className="w-4 h-4 mr-2" />
              Generate Custom Report
            </Button>
          </div>
        </div>
      </div>
    </Layout>
  );
}
