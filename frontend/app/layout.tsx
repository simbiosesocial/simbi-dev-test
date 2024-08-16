import "@/app/globals.css";

import { ThemeProvider } from "@mui/material/styles";
import { theme } from "@/common/theme";
import { Sidebar } from "@/features/components/Sidebar/Sidebar.component";
import { Box } from "@mui/material";
import { Copyright, Header } from "@/common/components";
import AppProvider from "@/common/providers/AppProvider";

export const metadata = {
  title: {
    template: "%s | Simbi",
    default: "Simbi",
  },
};

export default function RootLayout({ children }: { children: React.ReactNode }) {
  return (
    <html lang="pt-BR">
      <body className="flex is-full min-bs-full flex-auto flex-col">
        <ThemeProvider theme={theme}>
          <AppProvider>
            <Box className="flex min-h-screen">
              <Sidebar />
              <Box className="flex-1 flex flex-col">
                <Header />
                <Box component="main" sx={{ flex: 1, py: 6, px: 4, bgcolor: "#eaeff1" }}>
                  {children}
                </Box>
                <Box component="footer" sx={{ p: 2, bgcolor: "#eaeff1" }}>
                  <Copyright />
                </Box>
              </Box>
            </Box>
          </AppProvider>
        </ThemeProvider>
      </body>
    </html>
  );
}
