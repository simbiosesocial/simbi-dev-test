import { Alert, AlertColor, Snackbar, SnackbarOrigin } from "@mui/material";
import { Dispatch, ReactElement, SetStateAction } from "react";

interface SnackAlertParams {
  open: boolean;
  setOpen: Dispatch<SetStateAction<boolean>>; 
  severity: AlertColor;
  children: string | ReactElement;
  key?: any;
  vertical?: SnackbarOrigin['vertical']; 
  horizontal?: SnackbarOrigin['horizontal']; 
  variant?: 'standard' | 'filled' | 'outlined';
  autoHideDuration?: number;
}

const SnackAlert = ({ 
  open, 
  setOpen, 
  severity,
  children,
  key=severity,
  vertical='bottom', 
  horizontal='right', 
  variant="filled",
  autoHideDuration=3500,
}: SnackAlertParams) => {
  return (
    <Snackbar 
      open={open} 
      autoHideDuration={autoHideDuration} 
      onClose={() => setOpen(false)}
      anchorOrigin={{ vertical, horizontal }}
      key={key}
    >
      <Alert
        onClose={() => setOpen(false)}
        severity={severity}
        variant={variant}
        sx={{ width: '100%' }}
      >
        {children}
      </Alert>
    </Snackbar>
  );
}

export default SnackAlert;
