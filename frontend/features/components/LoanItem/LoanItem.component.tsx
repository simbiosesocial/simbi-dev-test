import type { FunctionComponent } from "react";
import type { LoanItemProps } from "./LoanItem.interface";
import { Card, CardContent, CardActions, Button, Typography, Tooltip } from "@mui/material";
import dateStringToHumanFormat from "@/common/utils/dateStringToHumanFormat";

export const LoanItem: FunctionComponent<LoanItemProps> = (loan: LoanItemProps) => {
  return (
    <Card variant="outlined">
      <CardContent>
        <Tooltip title={loan.loaned_book.title} arrow>
          <Typography gutterBottom variant="h5" noWrap>
            {loan.loaned_book.title}
          </Typography>
        </Tooltip>
        <Typography variant="body2" color="text.secondary">
          De {dateStringToHumanFormat(loan.start_loan_date)} até {dateStringToHumanFormat(loan.end_loan_date)}
        </Typography>
      </CardContent>
      <CardActions>
        <Button size="small" variant="contained" fullWidth>
          Devolver
        </Button>
      </CardActions>
    </Card>
  );
};
