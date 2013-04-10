#include <stdlib.h>
#include <argp.h>
const char *argp_program_version =
"argp-ex3 1.0";
const char *argp_program_bug_address =
"<bug-gnu-utils@gnu.org>";
 
/* Program documentation. */
static char doc[] =
"Argp example #3 -- a program with options and arguments using argp";
 
/* A description of the arguments we accept. */
static char args_doc[] = "ARG1 ARG2";
 
/* The options we understand. */
static struct argp_option options[] = {

//glxCodeGen delimitator

	{"verbose", 	'v', 	0, 	0, 	"Produce verbose output", 	0 },
	{"silent", 	's', 	0, 	0, 	"Don't produce any output", 	0 },
	{"output", 	'o', 	"FILE", 	0, 	"Output to FILE instead of standard output", 	0 },
	{"a", 	2000, 	"INPUT_NUMBER", 	0, 	"Input float number", 	0 },
	{"b", 	2001, 	"INPUT_NUMBER", 	0, 	"Input integer number", 	0 },

//glxCodeGen delimitator

	{ 0 }
};
 
/* Used by main to communicate with parse_opt. */
struct arguments
{
	char *args[2];                /* arg1 & arg2 */

//glxCodeGen delimitator2

	int verbose;
	int silent;
	char* output;
	float a;
	int b;

//glxCodeGen delimitator2

};
 
/* Parse a single option. */
static error_t
parse_opt (int key, char *arg, struct argp_state *state)
{
	/* Get the input argument from argp_parse, which we
	 know is a pointer to our arguments structure. */
	struct arguments *arguments = state->input;
	 
	switch (key)
	{
//glxCodeGen delimitator3

	case 'v' : 
		arguments->verbose = 1;
		break;
	case 's' : 
		arguments->silent = 1;
		break;
	case 'o' : 
		arguments->output = arg;
		break;
	case 2000 : 
		arguments->a = arg ? atof (arg) : 10;
		break;
	case 2001 : 
		arguments->b = arg ? atoi (arg) : 10;
		break;

//glxCodeGen delimitator3

		case ARGP_KEY_ARG:
			if (state->arg_num >= 2)
				/* Too many arguments. */
				argp_usage (state);
			 
			arguments->args[state->arg_num] = arg;
			 
			break;
			 
		case ARGP_KEY_END:
			if (state->arg_num < 2)
				/* Not enough arguments. */
				argp_usage (state);
			break;
			 
		default:
			return ARGP_ERR_UNKNOWN;
	}
	return 0;
}
 
/* Our argp parser. */
static struct argp argp = { options, parse_opt, args_doc, doc };

int
main (int argc, char **argv)
{
	struct arguments arguments;

//glxCodeGen delimitator4

	arguments.verbose = 0;
	arguments.silent = 0;
	arguments.output = "-";
	arguments.a = 45.87;
	arguments.b = 90;

//glxCodeGen delimitator4
 
	/* Parse our arguments; every option seen by parse_opt will
	 be reflected in arguments. */
	argp_parse (&argp, argc, argv, 0, 0, &arguments);
	 
	printf ("\nARG1 = %s\nARG2 = %s\nOUTPUT_FILE = %s\n"
			"VERBOSE = %s\nSILENT = %s\na = %.2f\nb = %d\n\n",
			arguments.args[0], arguments.args[1],
			arguments.output,
			arguments.verbose ? "yes" : "no",
			arguments.silent ? "yes" : "no",
			arguments.a,
			arguments.b);
	 
	exit (0);
}


