import { Typography } from "@mui/material";
import Link from "next/link";
import type { FunctionComponent } from "react";

export const Copyright: FunctionComponent = () => {
  return (
    <Typography variant="body2" align="center" sx={{ color: "text.secondary" }}>
      {"Copyright © "}
      <Link color="inherit" href="https://simbi.social/">
        Simbi
      </Link>{" "}
      {new Date().getFullYear()}.
    </Typography>
  );
};
