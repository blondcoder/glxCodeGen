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



//glxCodeGen delimitator

	{ 0 }
};
 
/* Used by main to communicate with parse_opt. */
struct arguments
{
	char *args[2];                /* arg1 & arg2 */

//glxCodeGen delimitator2



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


