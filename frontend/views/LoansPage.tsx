"use client";

import AppBar from "@mui/material/AppBar";
import Toolbar from "@mui/material/Toolbar";
import Paper from "@mui/material/Paper";
import Grid from "@mui/material/Grid";
import TextField from "@mui/material/TextField";
import SearchIcon from "@mui/icons-material/Search";
import { LoansList } from "@/features/components";
import { Box } from "@mui/material";
import { useState } from "react";
import { Loan } from "@/declarations";

type ViewProps = {
  loans: Loan[];
};

export default function LoansPageView({ loans = [] }: ViewProps) {
  const [searchQuery, setSearchQuery] = useState<string>('');

  const handleSearchChange = (e: React.ChangeEvent<HTMLInputElement>) => {
    setSearchQuery(e.target.value);
  };

  const searchLoans = (loans: Loan[], searchParams: string): Loan[] => {
    return loans.filter(loan => {
      const matchesId = loan.id.includes(searchParams);
      const matchesAuthor =  loan.book.author.name.toLowerCase().includes(searchParams.toLowerCase());
      const matchesTitle = loan.book.title.toLowerCase().includes(searchParams.toLowerCase());
      const matchesStatus = loan.status.includes(searchParams.toLowerCase());

      return matchesId || matchesAuthor || matchesTitle || matchesStatus;
    });
  }

  const filteredLoans = searchLoans(loans, searchQuery);
  return (
    <Paper sx={{ maxWidth: 936, margin: "auto", overflow: "hidden" }}>
      <AppBar position="static" color="default" elevation={0} sx={{ borderBottom: "1px solid rgba(0, 0, 0, 0.12)" }}>
        <Toolbar>
          <Grid   container spacing={2} sx={{ alignItems: "center" }}>
            <Grid item>
              <SearchIcon color="inherit" sx={{ display: "block" }} />
            </Grid>
            <Grid item xs>
              <TextField
                fullWidth
                placeholder="Pesquisar pelo título, autor ou ID"
                InputProps={{
                  disableUnderline: true,
                  sx: { fontSize: "default" },
                }}
                variant="standard"
                value={searchQuery}
                onChange={handleSearchChange}
              />
            </Grid>
            <Grid item>

            </Grid>
          </Grid>
        </Toolbar>
      </AppBar>
      <Box sx={{ my: 5, mx: 2 }}>
        <LoansList loans={filteredLoans} />
      </Box>
    </Paper>
  );
}
